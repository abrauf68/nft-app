<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            $user = User::find(Auth::user()->id);
            $notifications = Notification::where('user_id', $user->id)->orderByRaw('read_at IS NULL DESC')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('frontend.pages.notifications', compact('notifications'));
        } catch (\Throwable $th) {
            Log::error("Notification Index Failed:" . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to load notifications.');
        }
    }

    public function markAsRead($id)
    {
        try {
            $user = User::find(Auth::user()->id);
            $notification = Notification::findOrFail($id);
            $notification->read_at = now();
            $notification->save();
            return redirect()->back()->with('success', 'Notification marked as read.');
        } catch (\Throwable $th) {
            Log::error("Notification Mark as Read Failed:" . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to mark notification as read.');
        }
    }

    public function markAllAsRead()
    {
        try {
            $user = User::where('id', Auth::user()->id);
            $notifications = Notification::where('user_id', Auth::user()->id)->whereNull('read_at')->get();
            foreach ($notifications as $notification) {
                $notification->read_at = now();
                $notification->save();
            }
            return redirect()->back()->with('success', 'All notifications marked as read.');
        } catch (\Throwable $th) {
            Log::error("Notification Mark All as Read Failed:" . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to mark all notifications as read.');
        }
    }
    public function deleteNotification($id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return redirect()->back()->with('success', 'Notification deleted successfully.');
        } catch (\Throwable $th) {
            Log::error("Notification Deletion Failed:" . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to delete notification.');
        }
    }
    public function deleteAllNotifications()
    {
        try {
            $user = User::find(Auth::user()->id);
            $notifications = Notification::where('user_id', $user->id)->get();
            foreach ($notifications as $notification) {
                $notification->delete();
            }
            return redirect()->back()->with('success', 'All notifications deleted successfully.');
        } catch (\Throwable $th) {
            Log::error("Notification Deletion Failed:" . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to delete notifications.');
        }
    }
}
