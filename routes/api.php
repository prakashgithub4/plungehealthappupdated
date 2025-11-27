<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;

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
Route::get('v1/genders', [\App\Http\Controllers\API\GenderController::class, 'index']);

Route::group(['prefix' => 'v1/customer'], function () {
    Route::post('/verify-phone', [CustomerController::class, 'verifyPhone']);
    Route::post('/verify-email', [CustomerController::class, 'verifyEmail']);
    Route::post('/mobile-verify', [CustomerController::class, 'mobileVerifyRequest']);
    Route::post('/email-verify', [CustomerController::class, 'emailVerifyRequest']);
    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);
    Route::post('/verified', [CustomerController::class, 'verified']);
});
