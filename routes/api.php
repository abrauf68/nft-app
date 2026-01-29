<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/crypto', [HomeController::class, 'cryptoData']);
Route::post('/check-invitation-code', [RegisterController::class, 'checkInvitationCode'])->name('check.invitation.code');
