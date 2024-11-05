<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\ForgetController;
use App\HTTP\Controllers\ResetController;
use App\HTTP\Controllers\UserController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Login Route
Route::post('/login', [AuthController::class, 'Login']);

//Register Route
Route::post('/register', [AuthController::class, 'Register']);

//Forget Password Route
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);

//Reset Password Route
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);

//Current User Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');