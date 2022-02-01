<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\authController;
use \App\Http\Controllers\userController;
use \App\Http\Controllers\courseController;
use \App\Http\Controllers\TimingController;

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
Route::post('/register',[authController::class,'register']);
Route::post('/login',[authController::class,'login']);

Route::get("/courses",[courseController::class,"index"]);
Route::get("/courses/{id}",[courseController::class,"show"]);

// protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::delete('/logout',[AuthController::class,'logout']);
    Route::get('/users',[userController::class,'index']);
    Route::post('/addUser',[userController::class,'store']);
    Route::post('/removeUser',[userController::class,'removeUser']);

    Route::post("/courses",[courseController::class,"store"]);

    Route::apiResource("timings", TimingController::class);

});

