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
    if ($request->user()->removed == 1){
        return response("",500);
    }
    return $request->user();
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
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'reset']);



// protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {

    // Resend link to verify email
    Route::post('/email/verify/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response('Verification link sent!',200);
    })->middleware(['auth', 'throttle:6,1']);


    Route::delete('/logout',[AuthController::class,'logout']);

    Route::put('/changePassword',[AuthController::class,'changePassword']);

    Route::get('/users',[userController::class,'index']);
    Route::post('/addUser',[userController::class,'store']);
    Route::post('/editUser',[userController::class,'update']);
    Route::get('/user/{id}',[userController::class,'getUser']);
    Route::post('/editProfile',[userController::class,'editProfile']);
    Route::post('/removeUser',[userController::class,'removeUser']);

    Route::post("/courses",[courseController::class,"store"]);
    Route::post("/courseUpdate",[courseController::class,"update"]);
    Route::put("/courseDestroy/{id}",[courseController::class,"destroy"]);

    Route::apiResource("timings", TimingController::class);
    Route::post("check_times", [TimingController::class,"checkTimes"]);

    Route::post("bookings",[ bookingController::class,"store" ]);

    Route::get("coming_bookings",[ bookingController::class,"coming_bookings" ]);

    Route::post("create_meeting",[ MeetingController::class,"createMeeting" ]);
    Route::get("meetingsAll",[ MeetingController::class,"getMeetings" ]);

    Route::get("bookings/{id}",[ bookingController::class,"myBooking" ]);
    Route::get("bookingsPayCheck/{id}",[ bookingController::class,"bookingsPayCheck" ]);
    Route::get("bookings_list/{id}",[ bookingController::class,"bookingsList" ]);

    Route::post("bookingsPresenting", [ bookingController::class, "bookingsPresenting" ]);

    Route::delete("deleteBooking/{booking_group_id}", [ bookingController::class, "deleteBooking" ]);

    Route::post("setPayment", [ paymentController::class, "store" ]);

    Route::get("myPayments", [ paymentController::class, "myPayments" ]);
    Route::get("paymentsAdmin", [ paymentController::class, "allPayments" ]);
    Route::get("checkPayments/{id}", [ paymentController::class, "checkPayments" ]);

});

