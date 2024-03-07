<?php

use App\Http\Controllers\AuthController;
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
    Route::post('me',  [AuthController::class,'me']);
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('api');

});


Route::middleware(['admin','auth'])->group(function () {

});

Route::middleware(['organizer','auth'])->group(function () {

});

Route::middleware(['auth'])->group(function () {
Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post('logout',  [AuthController::class,'logout']);
});