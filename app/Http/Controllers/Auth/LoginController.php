<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassOTPMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('frontend.auth.login');
        }
    }

    /**
     * User Login Attempt
     */
    public function login_attempt(Request $request)
    {
        // Validate the form
        $rules = [
            'email_username' => 'required|max:50',
            'password' => 'required',
        ];

        // If captcha is used
        if (config('captcha.version') !== 'no_captcha') {
            $rules['g-recaptcha-response'] = 'required|captcha';
        } else {
            $rules['g-recaptcha-response'] = 'nullable';
        }

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            // Determine whether the input is an email or username
            $userfind = null;
            if (filter_var($request->email_username, FILTER_VALIDATE_EMAIL)) {
                // If it's an email, search by email
                $userfind = User::where('email', $request->email_username)->first();
            } else {
                // If it's not an email, assume it's a username and search by username
                $userfind = User::where('username', $request->email_username)->first();
            }

            if ($userfind) {
                // Check if the password is correct
                if (Hash::check($request->password, $userfind->password)) {
                    // Password matched
                    $remember_me = $request->remember ? true : false;
                    Auth::attempt(['email' => $userfind->email, 'password' => $request->password], $remember_me);

                    if (Auth::check()) {
                        return redirect()->route('dashboard')->with('success', "Login successfully!");
                    } else {
                        return redirect()->back()->withInput($request->all())->with('error', 'Authentication Error');
                    }
                } else {
                    return redirect()->back()->withInput($request->all())->with('error', 'Password is mismatch');
                }
            } else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to Login:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function sendOTP(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        // If captcha is used
        if (config('captcha.version') !== 'no_captcha') {
            $rules['g-recaptcha-response'] = 'required|captcha';
        } else {
            $rules['g-recaptcha-response'] = 'nullable';
        }

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                do {
                    $otp = rand(1000, 9999);
                } while (User::where('otp', $otp)->exists());
                // $otp = '1234';
                $user->otp = $otp;
                $user->otp_expires_at = Carbon::now()->addMinutes(10);
                $user->save();
                // ✅ Send OTP email
                Mail::to($user->email)->send(new ForgetPassOTPMail($user, $otp));

                return redirect()->route('otp-verification', ['email' => $request->email])->with('success', "OTP sent successfully!");
            } else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to send OTP:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function otp_verification()
    {
        return view('frontend.auth.passwords.otp-verification');
    }

    public function verify_otp(Request $request)
    {
        $rules = [
            'otp' => 'required|exists:users,otp',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::where('otp', $request->otp)->first();
            if ($user) {
                if (Carbon::now()->greaterThan($user->otp_expires_at)) {
                    return redirect()->back()->with('error', 'OTP expired');
                }

                $user->otp_verified_at = Carbon::now();
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->save();
                return redirect()->route('reset-password', ['email' => $user->email])->with('success', "OTP verified successfully!");
            } else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to verify OTP:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function resend_otp($email)
    {
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }
            // Check if previous OTP is still valid
            if ($user->otp_expires_at && Carbon::now()->lessThan($user->otp_expires_at)) {
                return redirect()->back()->with('error', 'Previous OTP is still valid. Please wait before requesting a new one.');
            }
            // Generate new OTP
            do {
                $otp = rand(1000, 9999);
            } while (User::where('otp', $otp)->exists());

            // $otp = '1234';

            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            // Send OTP email
            Mail::to($user->email)->send(new ForgetPassOTPMail($user, $otp));
            return redirect()->back()->with('success', 'A new OTP has been sent to your email.');
        } catch (\Throwable $th) {
            Log::error("Failed to resend OTP:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function reset_password(Request $request)
    {
        try {
            $user = User::where('email', $request->query('email'))->first();
            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found.');
            }
            if (!$user->otp_verified_at) {
                return redirect()->route('login')->with('error', 'OTP not verified. Please verify OTP first.');
            }
            $email = $request->query('email');
            return view('frontend.auth.passwords.reset', compact('email'));
        } catch (\Throwable $th) {
            Log::error("Failed to access reset password page:" . $th->getMessage());
            return redirect()->route('login')->with('error', "Something went wrong! Please try again later");
        }
    }

    public function reset_password_attempt(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
            'confirm-password' => 'required|same:password',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (!$user->otp_verified_at) {
                    return redirect()->route('login')->with('error', 'OTP not verified. Please verify OTP first.');
                }

                $user->password = Hash::make($request->password);
                $user->otp_verified_at = null;
                $user->save();

                return redirect()->route('login')->with('success', "Password reset successfully!");
            } else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to reset password:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }
}
