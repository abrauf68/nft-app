<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\OTPVerifyMail;
use App\Models\Profile;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('frontend.auth.register');
        }
    }

    public function register_attempt(Request $request)
    {

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => 'required|same:password',
            'invitation_code' => 'nullable|string|max:255|exists:users,username',
            'terms' => 'required|string|max:255',
        ];

        // Make 'g-recaptcha-response' nullable if CAPTCHA is not enabled
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
            // Begin a transaction
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->email_verified_at = now();
            $user->password = Hash::make($request->password);


            $username = $this->generateUsername($request->name);

            while (User::where('username', $username)->exists()) {
                $username = $this->generateUsername($request->name);
            }
            $user->username = $username;
            $user->save();

            $user->syncRoles('user');

            if($request->invitation_code){
                $inviter = User::where('username', $request->invitation_code)->first();
                if($inviter){
                    $user->inviter_id = $inviter->id;
                    $user->save();
                }
            }

            $randomNumber = rand(1, 10);
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $request->name;
            $profile->profile_image = "frontAssets/images/avatars/{$randomNumber}.png";
            $profile->save();

            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->wallet_address = Helper::generateUniqueWalletAddress();
            $wallet->balance = 0.00;
            $wallet->status = 'active';
            $wallet->save();

            // Attempt to authenticate
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);


            if (Auth::check()) {
                do {
                    $otp = rand(1000, 9999);
                } while (User::where('otp', $otp)->exists());

                // Save OTP to user record
                $user->otp = $otp;
                $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
                $user->save();

                $subject = 'Verify Your Email Address';

                // ✅ Send OTP email
                Mail::to($user->email)->send(new OTPVerifyMail($user, $otp, $subject));


            }
            app('notificationService')->notifyUsers([$user], 'Registered Successfully' ,'Welcome to ' . Helper::getCompanyName());

            // Commit the transaction
            DB::commit();

            return redirect()->route('login')->with('success', 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            // Log the error for debugging
            Log::error('User registration failed', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
            // throw $th;
        }
    }

    public function generateUsername($name)
    {
        // convert name to lowercase and remove spaces
        $name = strtolower(str_replace(' ', '', $name));

        // generate 4 random digits
        $random = rand(1000, 9999);

        // limit the name part so total length doesn't exceed 8 characters
        $maxNameLength = 8 - strlen($random);
        $shortName = substr($name, 0, $maxNameLength);

        // combine both parts
        $username = $shortName . $random;

        return $username;
    }


    // protected function generateUsername($name)
    // {
    //     $firstThreeLetters = strtoupper(substr($name, 0, 3));
    //     $randomNumber = rand(1000, 999999);
    //     return $firstThreeLetters . $randomNumber;
    // }


    public function checkInvitationCode(Request $request)
    {
        $invitationCode = $request->invitation_code;
        $user = User::where('username', $invitationCode)->first();
        if ($user) {
            return response()->json([
                'status' => 'matched',
                'user' => $user,
            ]);
        } else {
            return response()->json(['status' => 'not_matched']);
        }
    }
}
