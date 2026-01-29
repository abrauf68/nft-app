<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\Transaction;
use App\Models\UserReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RewardController extends Controller
{
    public function index()
    {
        try {
            $rewards = Reward::where('status', 'active')->latest()->get();
            $userClaimedRewards = UserReward::where('user_id', auth()->id())->pluck('reward_id')->toArray();
            return view('frontend.pages.rewards', compact('rewards', 'userClaimedRewards'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading reward page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function claimReward($id)
    {
        try {
            DB::beginTransaction();
            $reward = Reward::where('id', $id)
                ->where('status', 'active')
                ->firstOrFail();

            $user = auth()->user();

            // Check if already claimed
            $userReward = UserReward::where('user_id', $user->id)
                ->where('reward_id', $reward->id)
                ->first();

            if (!$userReward) {

                $userReward = new UserReward();
                $userReward->user_id   = $user->id;
                $userReward->reward_id = $reward->id;
                $userReward->status    = 'claimed';
                $userReward->save();

                // Here you can add logic to credit the reward amount to the user's account/wallet
                Transaction::create([
                    'user_id' => $user->id,
                    'money_flow' => 'in',
                    'transaction_type' => 'reward',
                    'amount' => $reward->reward_amount,
                    'transaction_id' => uniqid('txn_'),
                    'description' => 'Reward claimed: ' . $reward->title,
                ]);

                $userWallet = $user->wallet;
                if ($userWallet) {
                    $userWallet->balance += $reward->reward_amount;
                    $userWallet->save();
                }
            }

            // Redirect user to external reward page
            DB::commit();
            return redirect()->away($reward->action_url);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error claiming reward: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Unable to claim reward.');
        }
    }
}
