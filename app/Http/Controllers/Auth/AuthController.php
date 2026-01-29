<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\OTPVerifyMail;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function resendOTP()
    {
        try {
            if (Auth::check()) {

                $user = User::find(Auth::user()->id);
                // Check if previous OTP is still valid
                if ($user->otp_expires_at && Carbon::now()->lessThan($user->otp_expires_at)) {
                    return redirect()->back()->with('error', 'Previous OTP is still valid. Please wait before requesting a new one.');
                }
                do {
                    $otp = rand(1000, 9999);
                } while (User::where('otp', $otp)->exists());
                $user->otp = $otp;
                $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
                $user->save();

                $subject = 'Resend OTP Verification Code';

                // ✅ Send OTP email
                Mail::to($user->email)->send(new OTPVerifyMail($user, $otp, $subject));

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

            if($user->inviter_id){
                $referralBonus = Helper::getReferralBonus();
                $inviter = User::find($user->inviter_id);
                if($inviter){
                    $inviterWallet = $inviter->wallet;
                    if($inviterWallet){
                        $inviterWallet->balance += $referralBonus;
                        $inviterWallet->save();

                        // Log the transaction
                        Transaction::create([
                            'user_id' => $inviter->id,
                            'money_flow' => 'in',
                            'transaction_type' => 'referral_bonus',
                            'amount' => $referralBonus,
                            'transaction_id' => uniqid('txn_'),
                            'description' => 'Referral bonus for inviting user: ' . $user->email,
                        ]);
                    }
                }
            }
            return redirect()->route('frontend.home')->with('success', 'Your email has been verified successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }
}
