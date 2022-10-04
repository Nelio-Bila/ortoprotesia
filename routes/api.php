<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthProfessionalController;
use App\Models\HealthProfessional;

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

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, PATCH, DELETE');
// header('Access-Control-Allow-Headers: Accept, Content-Type, X-Auth-Token, Origin, Authorization');

// Users
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot', [ForgotController::class, 'forgot']);
Route::post('reset', [ForgotController::class, 'reset']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:user');
Route::get('user/{id}', [AuthController::class, 'details'])->middleware('auth:user');
Route::put('user/update/{id}', [AuthController::class, 'update'])->middleware('auth:user');
Route::get('users', [AuthController::class, 'index']);
Route::post('logout', [AuthController::class, 'logout']);

//

// Health professional
Route::post('hp/login', [HealthProfessionalController::class, 'login']);
Route::post('hp/logout', [HealthProfessionalController::class, 'logout'])->middleware('auth:hp-api');
Route::post('hp/register', [HealthProfessionalController::class, 'store']);
Route::post('hp/forgot', [HealthProfessionalController::class, 'forgot']);
Route::post('hp/reset', [HealthProfessionalController::class, 'reset']);
Route::get('hp', [HealthProfessionalController::class, 'hp'])->middleware('auth:hp-api');


// dashboard
Route::get('hpros', [HealthProfessionalController::class, 'index']);
Route::get('hpro/{id}', [HealthProfessionalController::class, 'show']);

// Administrator
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/logout', [AdminController::class, 'logout'])->middleware('auth:admin-api');
Route::post('admin/register', [AdminController::class, 'store']);
Route::post('admin/update/{id}', [AdminController::class, 'update'])->middleware('auth::admin-api');
Route::post('admin/forgot', [AdminController::class, 'forgot']);
Route::post('admin/reset', [AdminController::class, 'reset']);
Route::get('admin', [AdminController::class, 'admin']);
Route::get('admin/{id}', [AdminController::class, 'getAdmin']);
Route::delete('admin/{category}', [AdminController::class, 'destroy'])->middleware('auth::admin-api');
Route::get('admins', [AdminController::class, 'index']);
Route::get('registersPerDay', [AdminController::class, 'registersPerDay']);
Route::get('readersPerCategory', [AdminController::class, 'readersPerCategory']);

// Category
Route::get('categories', [CategoryController::class, 'index']);
Route::post('category/register', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy']);


// Articles
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/views/day/{hp}', [ArticleController::class, 'articlesViewsPerDay']);
Route::get('articles/me/{id}', [ArticleController::class, 'myArticles']);
Route::get('/articles/views/{id}', [ArticleController::class, 'myViewsCount']);
Route::get('/articles/views/today/{id}', [ArticleController::class, 'myTodayViewsCount']);
Route::get('article/{id}', [ArticleController::class, 'show']);
Route::get('articles/related/{id}/{article}', [ArticleController::class, 'related']);
Route::get('/articles/search/{criteria}', [ArticleController::class, 'search']);
Route::get('/articles/latest', [ArticleController::class, 'latest']);
Route::get('/articles/category/{category_id}', [ArticleController::class, 'byCategory']);
Route::get('/articles/period/{period}', [ArticleController::class, 'byPeriod']);
Route::get('/articles/popularity/{popularity}', [ArticleController::class, 'byViews']);
Route::post('/articles/register', [ArticleController::class, 'store']);
Route::post('/articles/increment/{article_id}/{user_id}/{who}', [ArticleController::class, 'incrementViews']);
Route::put('/articles/update/{id}', [ArticleController::class, 'update']);
Route::delete('/articles/delete/{id}', [ArticleController::class, 'destroy']);

// Process
Route::post('process/register', [ProcessController::class, 'store']);
Route::get('processes', [ProcessController::class, 'index']);


// Files
Route::post('/upload', [ImageController::class, 'store'])->name('upload');
Route::get('/media/{post}', [ImageController::class, 'getImages'])->name('post.images');
