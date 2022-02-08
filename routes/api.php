<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\authController;
use \App\Http\Controllers\userController;
use \App\Http\Controllers\courseController;
use \App\Http\Controllers\TimingController;
use \App\Http\Controllers\bookingController;
use \App\Http\Controllers\MeetingController;
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
    Route::post('/editProfile',[userController::class,'editProfile']);
    Route::post('/removeUser',[userController::class,'removeUser']);

    Route::post("/courses",[courseController::class,"store"]);

    Route::apiResource("timings", TimingController::class);
    Route::post("check_times", [TimingController::class,"checkTimes"]);

    Route::post("bookings",[ bookingController::class,"store" ]);

    Route::get("coming_bookings",[ bookingController::class,"coming_bookings" ]);

    Route::post("create_meeting",[ MeetingController::class,"createMeeting" ]);

    Route::get("bookings/{id}",[ bookingController::class,"myBooking" ]);
    Route::get("bookings_list/{id}",[ bookingController::class,"bookingsList" ]);

    Route::post("bookingsPresenting", [ bookingController::class, "bookingsPresenting" ]);

});

