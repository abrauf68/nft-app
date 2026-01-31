<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function index()
    {
        try {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            $withdraws = Withdraw::where('user_id', auth()->id())->latest()->paginate(10);
            return view('frontend.pages.withdraw', compact('wallet', 'withdraws'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading withdraw page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function request()
    {
        try {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            $withdrawalAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'out')->where('transaction_type', 'withdrawal')->where('status', 'completed')->sum('amount');
            $minimumWithdraw = Helper::minimumWithdraw();
            $latestWithdraw = Withdraw::where('user_id', auth()->id())->latest()->first();
            return view('frontend.pages.withdraw.request', compact('wallet', 'minimumWithdraw', 'withdrawalAmount', 'latestWithdraw'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading withdraw request page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function requestSubmit(Request $request)
    {
        $user = auth()->user();
        $wallet = Wallet::where('user_id', $user->id)->first();
        $minimumWithdraw = Helper::minimumWithdraw();
        $maxAmount = $wallet ? $wallet->balance : 0;

        // Validation rules
        $rules = [
            'amount'         => "required|numeric|min:$minimumWithdraw|max:$maxAmount",
            'crypto'         => 'required|string|max:255',
            'wallet_address' => 'required|string',
            'notes'          => 'nullable|string',
        ];

        $messages = [
            'amount.min' => "Minimum withdrawal amount is $minimumWithdraw",
            'amount.max' => "You cannot withdraw more than your current balance ($maxAmount)",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            DB::beginTransaction();

            if ($wallet) {
                $wallet->balance -= $request->amount;
                $wallet->save();
            }

            // Create a transaction record
            $transaction = Transaction::create([
                'user_id'          => $user->id,
                'money_flow'       => 'out',
                'transaction_type' => 'withdrawal',
                'amount'           => $request->amount,
                'transaction_id'   => uniqid('txn_'),
                'description'      => 'Withdrawal request',
                'currency'         => $request->crypto,
                'status'           => 'pending',
            ]);

            // Create a withdraw record
            $withdraw = Withdraw::create([
                'user_id'        => $user->id,
                'transaction_id' => $transaction->id,
                'amount'         => $request->amount,
                'crypto'         => $request->crypto,
                'wallet_address' => $request->wallet_address,
                'user_note'      => $request->notes ?? null,
                'status'         => 'pending',
            ]);

            // Send notification to the current user
            app('notificationService')->notifyUsers(
                [$user],
                'Withdrawal Requested',
                "Your withdrawal request of " . Helper::formatCurrency($request->amount) . " to {$request->crypto} wallet '{$request->wallet_address}' is pending. After processing we'll update you soon.",
                'withdraws',
                $withdraw->id,
                'withdraw'
            );

            DB::commit();

            return redirect()->route('frontend.withdraw.preview', $withdraw->id)
                ->with('success', 'Withdrawal request submitted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error submitting withdraw request: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function preview($withdrawId)
    {
        try {
            $user = auth()->user();
            $withdraw = Withdraw::with(['transaction', 'user.wallet'])
                ->where('id', $withdrawId)
                ->where('user_id', $user->id)
                ->firstOrFail();

            return view('frontend.pages.withdraw.preview', compact('withdraw'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading withdraw preview page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
}
