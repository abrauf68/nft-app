<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\UserReward;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    public function index()
    {
        try {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            $rewardAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'in')->where('transaction_type', 'reward')->where('status', 'completed')->sum('amount');
            $depositAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'in')->where('transaction_type', 'deposit')->where('status', 'completed')->sum('amount');
            $withdrawalAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'out')->where('transaction_type', 'withdrawal')->where('status', 'completed')->sum('amount');
            $referralAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'in')->where('transaction_type', 'referral_bonus')->where('status', 'completed')->sum('amount');
            $minedAmount = Transaction::where('user_id', auth()->id())->where('money_flow', 'in')->where('transaction_type', 'mined')->where('status', 'completed')->sum('amount');
            $reffralBonus = Helper::getReferralBonus();
            return view('frontend.pages.wallet', compact('wallet', 'rewardAmount', 'depositAmount', 'withdrawalAmount', 'referralAmount', 'minedAmount', 'reffralBonus'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading wallet page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function add()
    {
        try {
            $minimumDeposit = Helper::minimumDeposit();
            return view('frontend.pages.wallet.add', compact('minimumDeposit'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading add wallet page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function createCryptoPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'crypto' => 'required',
        ]);

        $user = auth()->user();

        $response = Http::withHeaders([
            'x-api-key' => config('services.nowpayments.key')
        ])->post('https://api.nowpayments.io/v1/invoice', [
            'price_amount' => $request->amount,
            'price_currency' => 'USD',
            'pay_currency' => $request->crypto,
            'order_id' => 'wallet_' . $user->id . '_' . time(),
            'order_description' => 'Wallet Topup',
            'ipn_callback_url' => route('frontend.crypto.webhook'),
            'success_url' => url('/wallet/success'),
            'cancel_url' => url('/wallet/cancel'),
        ]);

        $data = $response->json();

        Transaction::create([
            'user_id' => $user->id,
            'transaction_id' => uniqid('txn_'),
            'money_flow' => 'in',
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'currency' => $request->crypto,
            'payment_id' => $data['id'],
            'status' => 'pending',
        ]);

        return redirect($data['invoice_url']);
    }

    public function handle(Request $request)
    {
        $signature = hash_hmac(
            'sha512',
            $request->getContent(),
            config('services.nowpayments.ipn_secret')
        );

        if ($signature !== $request->header('x-nowpayments-sig')) {
            abort(403);
        }

        if ($request->payment_status === 'finished') {

            $transaction = Transaction::where('payment_id', $request->payment_id)
                ->where('status', 'pending')
                ->first();

            if (!$transaction) return;

            DB::transaction(function () use ($transaction, $request) {

                $wallet = Wallet::firstOrCreate([
                    'user_id' => $transaction->user_id
                ]);

                $wallet->increment('balance', $transaction->amount);

                $transaction->update([
                    'status' => 'completed',
                    'tx_hash' => $request->payin_hash,
                ]);
            });
        }
    }
}
