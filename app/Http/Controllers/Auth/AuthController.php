<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\OTPVerifyMail;
use App\Models\Appeal;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * User Logout
     */
    public function logout()
    {
        try {
            Auth::logout();
            return Redirect::route('login')->with('success', 'Logout Successfully!');
        } catch (\Throwable $th) {
            return Redirect::back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function login_verification()
    {
        if (Auth::user() && Auth::user()->email_verified_at !== null) {
            return view('auth.verification');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function verification_verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    public function verification_notice()
    {
        try {
            $user = Auth::user();
            if ($user->email_verified_at !== null) {
                return redirect()->route('dashboard');
            }
            return view('auth.verify-email');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function verification_send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function verification()
    {
        return view('frontend.auth.verification-page');
    }
    public function suspicious()
    {
        return view('frontend.auth.suspicious');
    }
    public function appealSuccess()
    {
        return view('frontend.auth.appeal-success');
    }
    public function appealSubmit(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'appeal_type' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            $appeal = new Appeal();
            $appeal->user_id = Auth::user()->id;
            $appeal->name = $request->name;
            $appeal->email = $request->email;
            $appeal->appeal_type = $request->appeal_type;
            $appeal->message = $request->message;
            $appeal->save();

            return redirect()->route('appeal.submit.success')->with('success', 'Appeal Submitted Successfully!');
        } catch (Exception $e) {
            Log::error('Appeal Submission failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', "Request Failed:" . $e->getMessage());
        }
    }
    public function appeal()
    {
        return view('frontend.auth.appeal');
    }
    public function resendOTP()
    {
        try {
            if (Auth::check()) {

                $user = User::find(Auth::user()->id);
                // Check if previous OTP is still valid
                if ($user->otp_expires_at && Carbon::now()->lessThan($user->otp_expires_at)) {
                    return redirect()->back()->with('error', 'Previous OTP is still valid. Please wait before requesting a new one.');
                }
                // do {
                //     $otp = rand(1000, 9999);
                // } while (User::where('otp', $otp)->exists());
                $otp = '0000';
                $user->otp = $otp;
                $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
                $user->save();

                $subject = 'Resend OTP Verification Code';

                // ✅ Send OTP email
                // Mail::to($user->email)->send(new OTPVerifyMail($user, $otp, $subject));

                return redirect()->back()->with('success', 'OTP has been resent successfully!');
            } else {
                return redirect()->route('login')->with('error', 'Authentication Error, please try again!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Request Failed:" . $e->getMessage());
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            $otp = implode('', $request->input('otp')); // combine array into string
            $user = User::findOrFail(Auth::id());

            // Parse OTP expiry as Carbon
            $expiresAt = Carbon::parse($user->otp_expires_at);

            // Check if OTP is expired first
            if (Carbon::now()->greaterThan($expiresAt)) {
                return back()->withErrors(['otp' => 'OTP has been expired.']);
            }

            // Check OTP match
            if ($otp != $user->otp) {
                return back()->withErrors(['otp' => 'Invalid OTP']);
            }

            // OTP is correct and not expired
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            if ($user->inviter_id) {

                $inviter = User::find($user->inviter_id);

                if ($inviter) {
                    if ($user->is_suspicious == '1') {
                        return redirect()->route('frontend.home')
                            ->with('success', 'Email verified. Referral under review.');
                    }

                    $alreadyRewarded = Transaction::where('transaction_type', 'referral_bonus')
                        ->where('description', 'like', "%{$user->id}%")
                        ->exists();

                    if ($alreadyRewarded) {
                        return redirect()->route('frontend.home');
                    }

                    $referralBonus = Helper::getReferralBonus();
                    $inviterWallet = $inviter->wallet;

                    $inviterWallet->increment('balance', $referralBonus);

                    Transaction::create([
                        'user_id' => $inviter->id,
                        'money_flow' => 'in',
                        'transaction_type' => 'referral_bonus',
                        'amount' => $referralBonus,
                        'transaction_id' => uniqid('txn_'),
                        'description' => 'Referral bonus for user ID: ' . $user->id,
                        'currency' => 'USD',
                        'status' => 'completed',
                    ]);

                    app('notificationService')->notifyUsers(
                        [$inviter],
                        'You Earned a Referral Bonus!',
                        "Your friend @{$user->username} has verified their email. You received a bonus of " . Helper::formatCurrency($referralBonus) . ".",
                        'users',
                        $user->id,
                        'share-and-earn'
                    );
                }
            }
            return redirect()->route('frontend.home')->with('success', 'Your email has been verified successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }
}
