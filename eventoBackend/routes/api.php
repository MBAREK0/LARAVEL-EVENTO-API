<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',  [AuthController::class,'login']);
    Route::post('refresh',  [AuthController::class,'refresh']);
    Route::post('forgetPassword',  [AuthController::class,'forgetPassword']);
    Route::post('resetPassword',  [AuthController::class,'resetPassword']);
    Route::post('me',  [AuthController::class,'me']);
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('api');

});


Route::middleware(['admin','auth'])->group(function () {
    // categories
    Route::post('store-category', [CategorieController::class,'store']);
    Route::post('destroy-category', [CategorieController::class,'destroy']);
    Route::post('update-category', [CategorieController::class,'update']);
    Route::get('index-category', [CategorieController::class,'index']);
    
});

Route::middleware(['organizer','auth'])->group(function () {

        // Events
    Route::post('store-event', [EventController::class,'store']);
    Route::post('destroy-event', [EventController::class,'destroy']);
    Route::post('update-event', [EventController::class,'update']);
    Route::get('show-event', [EventController::class,'show']);
    Route::get('index-event', [EventController::class,'index']);
});

Route::middleware(['auth'])->group(function () {

Route::post('logout',  [AuthController::class,'logout']);

});


Route::get('/user', function (Request $request) {
    return $request->user();
});
