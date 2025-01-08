<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/profile/send-verification-code', [ProfileController::class, 'sendVerificationCode'])->name('sendVerificationCode');
Route::post('/profile/verify', [ProfileController::class, 'verify'])->name('verify');