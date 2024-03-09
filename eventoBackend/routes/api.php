<?php

use App\Http\Controllers\AdminController;
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
    Route::delete('destroy-category', [CategorieController::class,'destroy']);
    Route::put('update-category', [CategorieController::class,'update']);

    // Users 
    Route::get('get-users', [AdminController::class,'getUsers']);
    Route::get('get-events', [AdminController::class,'getEvents']);
    Route::put('update-role', [AdminController::class,'updateRole']);
    Route::delete('destroy-user', [AdminController::class,'destroyUser']);
    Route::put('accept-event', [AdminController::class,'acceptEvent']);

    
});

Route::middleware(['organizer','auth'])->group(function () {

        // Events
    Route::post('store-event', [EventController::class,'store']);
    Route::post('store-image', [EventController::class,'storeImage']);
    Route::post('destroy-event', [EventController::class,'destroy']);
    Route::post('update-event', [EventController::class,'update']);
    Route::get('show-event', [EventController::class,'show']);
});

Route::middleware(['auth'])->group(function () {

Route::post('logout',  [AuthController::class,'logout']);
Route::get('index-category', [CategorieController::class,'index']);
Route::get('index-event', [EventController::class,'index']);



});


Route::get('/user', function (Request $request) {
    return $request->user();
});
