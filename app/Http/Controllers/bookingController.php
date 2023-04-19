<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Timing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Carbon\CarbonPeriod;

class bookingController extends Controller
{
    public function myBooking($id,Request $request)
    {
        $my_bookings = Booking::with(["timing","course","meetings"])
                            ->where("user_id",($request->user()->role_id == 1 ? $request->user()->id : $id))
                            ->get();

        $bookings_by_key = [];

        $booking_resources = BookingResource::collection($my_bookings);
        foreach ($booking_resources as $booking_resource) {
            $bookings_by_key[$booking_resource['booking_group_id']][]= $booking_resource;
        }
        return $bookings_by_key;
    }

    public function bookingsList($id,Request $request)
    {
        $myBookings = Booking::with(["timing","course"])
            ->whereIn("id",
                Booking::whereUser_id($request->user()->roler_id == 1 ? $request->user()->id : $id)
                    ->where("session_date", ">=", now())
                    ->groupBy("booking_group_id")->selectRaw("MIN(id) id")->pluck("id"))
            ->get();

        return $myBookings;
    }

    public function store(Request $request)
    {

        $start_date = Carbon::createFromFormat('Y-m-d H:i:s',now()
            ,"Africa/Cairo")->addDays(2);

        $end_date = Carbon::createFromFormat('Y-m-d H:i:s',now()
            ,"Africa/Cairo")->addDays(40);

        $period = CarbonPeriod::create($start_date, $end_date);

        $time = Carbon::createFromFormat('Y-m-d H:i:s',date("Y-m-d H:i:s"
                ,strtotime($request->time)),"Africa/Cairo");

        $booking_group_id = $this->generateBookingGroupId();

        $timing_days = collect(Timing::find($request->timing_id)->days);

        $key = 0;

        foreach ($period as $item) {
            if ($timing_days->contains($item->format("l"))
                && ($key != $timing_days->count() * 4) )
            {
                $key++;
                Booking::create([
                    "timing_id"=> $request->timing_id,
                    "course_id"=> $request->course_id,
                    "session_date"=> $item->format("Y-m-d ") . $time->format("H:i"),
                    "booking_group_id"=>$booking_group_id,
                    "session_num"=> $key,
                    "duration" => $request->duration,
                    "user_id"=> $request->user()->id
                ]);
            }
        }

        return "DONE";
    }

    public function generateBookingGroupId() {
        $number = mt_rand(1000000000, 9999999999);
        $number = abs($number);

        return $this->bookingGroupIdExists($number) ? $this->generateBookingGroupId() : $number;
    }

    public function bookingGroupIdExists($number) {
        return Booking::whereBooking_group_id($number)->exists();
    }

    public function comingBookings(){
        $myBookings = Booking::with(["timing","course","user","meetings"])
                        ->whereIn("bookings.id",Booking::groupBy("booking_group_id")
                                ->where("session_date",">",now())
                                ->selectRaw("MIN(id) id")
                                ->pluck("id"))
                        ->get();

        return $myBookings;
    }

    public function bookingsPresenting(Request $request)
    {
        if (!$request->user()->free_trail){
           $request->user()->update([ "free_trail" => "1" ]);
        }
        Booking::find($request->booking_id)->update([ "present" => "1" ]);

        return User::find($request->user()->id);
    }

    public function bookingsPayCheck($id,Request $request)
    {
        $bookingCheck = Booking::with(["timing","course"])
                         ->whereIdAndUser_id($id,$request->user()->id)
                         ->whereDoesntHave("payment")
                         ->first();

        return response($bookingCheck ?? "",$bookingCheck ? 200 : 500);
    }

    public function deleteBooking($booking_group_id)
    {
        Booking::whereBooking_group_id($booking_group_id)->delete();
        return "DONE";
    }
}
