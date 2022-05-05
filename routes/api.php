<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HealthProfessionalController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot', [ForgotController::class, 'forgot']);
Route::post('reset', [ForgotController::class, 'reset']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:api');

// Health professional
Route::post('hp/login', [HealthProfessionalController::class, 'login']);
Route::post('hp/register', [HealthProfessionalController::class, 'store']);
Route::post('hp/forgot', [HealthProfessionalController::class, 'forgot']);
Route::post('hp/reset', [HealthProfessionalController::class, 'reset']);
Route::get('hp', [HealthProfessionalController::class, 'store'])->middleware('auth::hp');

// Administrator
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/register', [AdminController::class, 'store']);
Route::post('admin/forgot', [AdminController::class, 'forgot']);
Route::post('admin/reset', [AdminController::class, 'reset']);
Route::get('admin', [AdminController::class, 'store'])->middleware('auth::admin');