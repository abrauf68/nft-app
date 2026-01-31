<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MiningMachine;
use App\Models\UserMining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiningController extends Controller
{
    public function index()
    {
        try {
            $miningMachines = MiningMachine::where('status', 'active')->get();
            $userMinings = UserMining::where('user_id', auth()->id())->get();
            return view('frontend.pages.mining.index', compact('miningMachines', 'userMinings'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading mining page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
}
