<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Timing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class bookingController extends Controller
{
    public function myBooking(Request $request)
    {
        $myBookings = Booking::with(["timing","course"])
                            ->where("user_id",$request->user()->id)
                            ->get();

        $myBookingsGroup = [];
        $date_now = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::now(),$request->user()->timezone);

        $check_coming = false;
        foreach ($myBookings as $myBooking) {

            $myBookingsGroup[$myBooking['booking_group_id']][] = [
                "present" => $myBooking['present'],
                "course_id" => $myBooking['course_id'],
                "booking_group_id" => $myBooking['booking_group_id'],
                "session_date" => date("Y-m-d",strtotime($myBooking['session_date'])),
                "day" => date("l",strtotime($myBooking['session_date'])),
                "status" => ($myBooking['session_date'] < $date_now ? "expired" : "incoming"),
                "current" => ($myBooking['session_date'] == $date_now ? true : false),
                "coming" =>($myBooking['session_date'] > $date_now && !$check_coming ? true : false),
                "timing" => $myBooking['timing'],
                "course" => $myBooking['course'],
            ];
            if ($myBooking['session_date'] > $date_now){
                $check_coming = true;
            }

        }

        return response($myBookingsGroup,201);
    }

    public function bookingsList(Request $request)
    {
        $myBookings = Booking::with(["timing","course"])
            ->where("user_id",$request->user()->id)->get();
        $allBookings = $this->getBooking($myBookings,$request->user()->timezone);

        $bookingsList = [];
        foreach ($allBookings as $allBooking) {
            foreach ($allBooking['courseTimes'] as $key => $courseTime) {
                if ($courseTime['coming']){
                    $allBooking['token_lect'] = $key ;
                    $allBooking['percent'] = ($key * 100) / 12;
                    $allBooking['time_diff'] = Carbon::parse($courseTime['date_time'])->diffForHumans(Carbon::now());
                }
            }
            if (!$allBooking['time_diff']){
                $allBooking['time_diff'] = false;
                $allBooking['percent'] = 12;
            }
            $bookingsList[] = $allBooking;
        }

        return response($bookingsList,201);
    }

    public function getBooking($myBookings,$timezone)
    {
        $allBookings = [];

        foreach ($myBookings as $myBooking) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking->start_date
                ,$timezone);

            $end_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking->start_date
                ,$timezone)->addDays(35);

            $period = CarbonPeriod::create($start_date, $end_date);

            $days = [];
            $timingDays= $myBooking->timing->days;
            $myBooking->time = Carbon::createFromFormat('Y-m-d H:i:s',
                $myBooking->timing->time
                ,$timezone);

            foreach ($period as $item) {
                $day = $item->format("l");
                $coming = $item->format("Y-m-d ") . $myBooking->time->format("H:i");
                if (in_array($day,$timingDays) && count($days) != 12){
                    $days[] = [
                        "date" => $item->format("Y-m-d"),
                        "day" => $day,
                        "date_time" =>$coming,
                        "status" => ($coming < date("Y-m-d H:i") ? "expired" : "incoming"),
                        "current" => ($coming == date("Y-m-d H:i") ? true : false),
                        "coming" => ($coming > date("Y-m-d H:i") && !in_array(true,array_column($days,"coming")) ? true : false),
                    ];
                }
            }
            $myBooking->courseTimes = $days;
            if (!$myBooking->expired_date){
                $expiredBooking = Booking::find($myBooking->id);
                $expiredBooking->expired_date = $days[count($days)-1]['date'] . " " . Carbon::parse($myBooking->time)->addHours(2)->format("H:i");
                $expiredBooking->save();
            }
            $allBookings[] = $myBooking;
        }

        return $allBookings;
    }

    public function store(Request $request)
    {

        $timing = Timing::find($request->timing_id)->first();
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::now()
                ,"Africa/Cairo");

            $end_date = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::now()
                ,"Africa/Cairo")->addDays(35);



            $period = CarbonPeriod::create($start_date, $end_date);

            $days = [];
            $timingDays= $timing->days;
            $time = Carbon::createFromFormat('Y-m-d H:i:s',$timing->time
                ,"Africa/Cairo");

            foreach ($period as $item) {
                $day = $item->format("l");
                $coming = $item->format("Y-m-d ") . $time->format("H:i");
                if (in_array($day,$timingDays) && count($days) != 12){
                    $days[] = [
                        "date" => $item->format("Y-m-d"),
                        "day" => $day,
                        "date_time" =>$coming,
                        "status" => ($coming < date("Y-m-d H:i") ? "expired" : "incoming"),
                        "current" => ($coming == date("Y-m-d H:i") ? true : false),
                        "coming" => ($coming > date("Y-m-d H:i") && !in_array(true,array_column($days,"coming")) ? true : false),
                    ];
                }
            }

        $booking_group_id = $this->generate_booking_group_id();

        foreach ($days as $day) {
            Booking::create([
                "timing_id"=> $request->timing_id,
                "course_id"=> $request->course_id,
                "session_date"=> $day['date_time'],
                "booking_group_id"=>$booking_group_id,
                "user_id"=> $request->user()->id
            ]);
        }


        return response("DONE",201);
    }

    public function generate_booking_group_id() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->booking_group_id_exists($number)) {
            return $this->generate_booking_group_id();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function booking_group_id_exists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Booking::whereBooking_group_id($number)->exists();
    }

}
