<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\CategoryController;
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
Route::get('user', [AuthController::class, 'user'])->middleware('auth:user');
Route::put('update', [AuthController::class, 'update'])->middleware('auth:user');

//

// Health professional
Route::post('hp/login', [HealthProfessionalController::class, 'login']);
Route::post('hp/register', [HealthProfessionalController::class, 'store']);
Route::post('hp/forgot', [HealthProfessionalController::class, 'forgot']);
Route::post('hp/reset', [HealthProfessionalController::class, 'reset']);
Route::get('hp', [HealthProfessionalController::class, 'store'])->middleware('auth:hp-api');

// Route::prefix('article')->group(function () {
//     Route::middleware(['auth:hp', 'auth:admin'])->group(function () {
//         Route::post('/store', [ArticleController::class, 'store']);
//         Route::put('/update/{article}', [ArticleController::class, 'update']);
//         Route::delete('/destroy/{article}', [ArticleController::class, 'destroy']);
//     });
//     Route::group(function () {
//         Route::get('/index', [ArticleController::class, 'index']);
//     });
// });

// Administrator
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/register', [AdminController::class, 'store']);
Route::post('admin/forgot', [AdminController::class, 'forgot']);
Route::post('admin/reset', [AdminController::class, 'reset']);
Route::get('admin', [AdminController::class, 'show'])->middleware('auth::admin-api');

Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories/register', [CategoryController::class, 'store']);
Route::get('category/{category}', [CategoryController::class, 'show']);
Route::put('categories/{category}', [CategoryController::class, 'update']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);



Route::post('/upload', [ImageController::class, 'store'])->name('upload');
Route::get('/media/{post}', [ImageController::class, 'getImages'])->name('post.images');