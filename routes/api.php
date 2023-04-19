<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\authController;
use \App\Http\Controllers\userController;
use \App\Http\Controllers\courseController;
use \App\Http\Controllers\TimingController;
use \App\Http\Controllers\bookingController;
use \App\Http\Controllers\MeetingController;
use \App\Http\Controllers\paymentController;
use App\Http\Controllers\VerifyEmailController;
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
    return $request->user()->removed == 1 ? response("",500) : $request->user();
});
Route::post('/register',[authController::class,'register']);
Route::post('/login',[authController::class,'login']);


Route::get("/courses",[courseController::class,"index"]);
Route::get("/courses/{id}",[courseController::class,"show"]);


// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// reset password
Route::post('forgot_password', [authController::class, 'forgotPassword']);
Route::post('reset_password', [authController::class, 'reset']);



// protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::post('/email/verify/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response('Verification link sent!',200);
    })->middleware(['auth', 'throttle:6,1']);


    Route::put('/change_password',[authController::class,'changePassword']);
    Route::post('/edit_profile',[authController::class,'editProfile']);
    Route::delete('/logout',[authController::class,'logout']);

    Route::get('/users',[userController::class,'index']);
    Route::post('/add_user',[userController::class,'store']);
    Route::post('/edit_user',[userController::class,'update']);
    Route::get('/user/{id}',[userController::class,'getUser']);
    Route::post('/remove_user',[userController::class,'removeUser']);

    Route::post("/courses",[courseController::class,"store"]);
    Route::post("/course_update",[courseController::class,"update"]);
    Route::put("/course_destroy/{id}",[courseController::class,"destroy"]);

    Route::apiResource("timings", TimingController::class);
    Route::post("check_times", [TimingController::class,"checkTimes"]);

    Route::post("bookings",[ bookingController::class,"store" ]);
    Route::get("coming_bookings",[ bookingController::class,"comingBookings" ]);
    Route::get("bookings/{id}",[ bookingController::class,"myBooking" ]);
    Route::get("bookings_pay_check/{id}",[ bookingController::class,"bookingsPayCheck" ]);
    Route::get("bookings_list/{id}",[ bookingController::class,"bookingsList" ]);
    Route::post("bookings_presenting", [ bookingController::class, "bookingsPresenting" ]);
    Route::delete("delete_booking/{booking_group_id}", [ bookingController::class, "deleteBooking" ]);

    Route::post("create_meeting",[ MeetingController::class,"createMeeting" ]);
    Route::get("meetings_all",[ MeetingController::class,"getMeetings" ]);

    Route::post("set_payment", [ paymentController::class, "store" ]);
    Route::get("my_payments", [ paymentController::class, "myPayments" ]);
    Route::get("payments_admin", [ paymentController::class, "allPayments" ]);
    Route::get("check_payments/{id}", [ paymentController::class, "checkPayments" ]);

});
