<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\MiningMachine;
use App\Models\Transaction;
use App\Models\UserMining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MiningController extends Controller
{
    public function index()
    {
        try {
            $userId = auth()->id();

            // Active machines (running)
            $activeMachineIds = UserMining::where('user_id', $userId)
                ->where('status', 'running')
                ->pluck('mining_machine_id')
                ->toArray();

            // Check if free machine already used
            $hasUsedFree = UserMining::where('user_id', $userId)
                ->whereHas('miningMachine', function ($q) {
                    $q->where('price', 0);
                })
                ->exists();

            // Filter machines
            $miningMachines = MiningMachine::where('status', 'active')
                ->whereNotIn('id', $activeMachineIds)
                ->when($hasUsedFree, function ($q) {
                    $q->where('price', '>', 0);
                })
                ->get();

            $userMinings = UserMining::with('miningMachine')
                ->where('user_id', $userId)
                ->where('status', 'running')
                ->get();

            $allUserMinings = UserMining::with('miningMachine')
                ->where('user_id', $userId)
                ->get();

            $totalMined = $allUserMinings->sum(function ($mining) {
                return $mining->total_earned ?? 0;
            });

            $totalMachines = $allUserMinings->count();

            $totalPower = $allUserMinings->sum(function ($mining) {
                return $mining->miningMachine->power ?? 0;
            });

            $activeMachines = $allUserMinings->where('status', 'running')->count();

            return view('frontend.pages.mining.index', compact('miningMachines', 'userMinings', 'totalMined', 'totalMachines', 'totalPower', 'activeMachines'));
        } catch (\Throwable $th) {
            Log::error('Error loading mining page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function show($slug)
    {
        try {
            $miningMachine = MiningMachine::where('slug', $slug)->where('status', 'active')->firstOrFail();
            return view('frontend.pages.mining.show', compact('miningMachine'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading mining machine page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the mining machine page.');
        }
    }

    public function purchase($slug)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $miningMachine = MiningMachine::where('slug', $slug)->where('status', 'active')->firstOrFail();
            $wallet = auth()->user()->wallet;
            if ($wallet->balance < $miningMachine->price) {
                return redirect()->back()->with('low_balance_error', 'Insufficient balance to purchase this mining machine.');
            }
            $userMining = new UserMining();
            $userMining->user_id = auth()->id();
            $userMining->mining_machine_id = $miningMachine->id;
            $startDate = now();
            $userMining->start_date = $startDate;
            $userMining->end_date = (clone $startDate)->addHours($miningMachine->duration_hours);
            $userMining->status = 'running';
            $userMining->daily_reward = $miningMachine->daily_reward;
            $userMining->total_earned = 0.00;
            $userMining->save();

            $wallet->balance -= $miningMachine->price;
            $wallet->save();

            Transaction::create([
                'user_id' => auth()->id(),
                'money_flow' => 'out',
                'transaction_type' => 'purchase',
                'amount' => $miningMachine->price,
                'transaction_id' => uniqid('txn_'),
                'description' => 'Purchase mining machine: ' . $miningMachine->name,
                'currency' => 'USD',
                'status' => 'completed',
            ]);

            app('notificationService')->notifyUsers(
                [$user],
                'Mining Machine Purchased!',
                "You successfully purchased the mining machine '{$miningMachine->name}' for " . Helper::formatCurrency($miningMachine->price) . ".",
                'user_minings',
                $miningMachine->id,
                'mining'
            );
            DB::commit();
            return redirect()->route('frontend.mining')->with('success', 'Mining machine purchased successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error('Error loading mining machine purchase page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the mining machine purchase page.');
        }
    }

    public function claim($id)
    {
        try {
            DB::beginTransaction();

            $mining = UserMining::with('miningMachine', 'user.wallet')
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            // ⛔ Already claimed
            if ($mining->status === 'completed') {
                return back()->with('error', 'Already claimed.');
            }

            // ⛔ Not completed yet
            if (now()->lt($mining->end_date)) {
                return back()->with('error', 'Mining not completed yet.');
            }

            $user = $mining->user;
            $wallet = $mining->user->wallet;
            $miningMachine = $mining->miningMachine;

            if (!$wallet) {
                return back()->with('error', 'Wallet not found.');
            }

            // ✅ Final reward
            $totalReward = $mining->miningMachine->total_reward ?? 0;

            // 💰 Add to wallet
            $wallet->balance += $totalReward;
            $wallet->save();

            // 🔄 Update mining
            $mining->status = 'completed';
            $mining->total_earned = $totalReward;
            $mining->save();

            // 🧾 Transaction log
            Transaction::create([
                'user_id' => auth()->id(),
                'money_flow' => 'in',
                'transaction_type' => 'mined',
                'amount' => $totalReward,
                'transaction_id' => uniqid('claim_'),
                'description' => 'Mining reward claimed',
                'currency' => 'USDT',
                'status' => 'completed',
            ]);

            app('notificationService')->notifyUsers(
                [$user],
                'Mining Reward Claimed',
                "You have successfully claimed your mining reward from the '{$miningMachine->name}' machine, valued at " . Helper::formatCurrency($miningMachine->price) . ".",
                'user_minings',
                $miningMachine->id,
                'mining'
            );

            DB::commit();

            return back()->with('success', 'Reward claimed successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong.');
        }
    }
}
