<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.pages.wallet');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading wallet page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
}
