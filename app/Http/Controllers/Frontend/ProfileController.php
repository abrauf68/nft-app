<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.pages.profile');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading profile page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
    public function edit()
    {
        try {
            $user = auth()->user();
            $profile = $user->profile;
            return view('frontend.pages.profile-edit', compact('user', 'profile'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading profile page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'profile_picture' => 'required|string|max:255',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::findOrFail(auth()->user()->id);
            $profile = Profile::where('user_id', $user->id)->first();
            if (!$profile) {
                $profile = new Profile();
                $profile->user_id = $user->id;
            }
            $profile->first_name = $request->name;
            $profile->phone_number = $request->phone_number;
            $profile->profile_image = $request->profile_picture;
            $profile->save();

            $user->name = $request->name;
            $user->save();
            return redirect()->route('frontend.profile')->with('success', 'Profile updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading profile page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function settings()
    {
        try {
            return view('frontend.pages.settings');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading settings page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the settings page.');
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_new_password' => 'required|string|same:new_password',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::findOrFail(auth()->user()->id);
            if (!password_verify($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Current Password is incorrect');
            }
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('frontend.settings')->with('success', 'Password changed successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error changing password: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while changing the password.');
        }
    }
}
