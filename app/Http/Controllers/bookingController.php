<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Timing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class bookingController extends Controller
{
    public function myBooking($id,Request $request)
    {
        $id = $request->user()->roler_id == 1 ? $request->user()->id : $id;
        $myBookings = Booking::with(["timing","course"])
                            ->where("user_id",$id)
                            ->get();

        $myBookingsGroup = [];
        $date_now = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::now(),$request->user()->timezone);

        $check_coming = false;
        foreach ($myBookings as $myBooking) {

            $lecture_start = $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking['session_date']
                ,$request->user()->timezone);

            $lecture_end = $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking['session_date']
                ,$request->user()->timezone)->addHour();

            $myBookingsGroup[$myBooking['booking_group_id']][] = [
                "id" => $myBooking['id'],
                "present" => $myBooking['present'],
                "course_id" => $myBooking['course_id'],
                "booking_group_id" => $myBooking['booking_group_id'],
                "session_date" => date("Y-m-d",strtotime($myBooking['session_date'])),
                "day" => date("l",strtotime($myBooking['session_date'])),
                "status" => ($myBooking['session_date'] < $date_now ? "expired" : "incoming"),
                "current" => ($date_now >= $lecture_start && $date_now <= $lecture_end ? true : false),
                "coming" =>($myBooking['session_date'] > $date_now && !$check_coming &&
                                !($date_now >= $lecture_start && $date_now <= $lecture_end) ? true : false),
                "timing" => $myBooking['timing'],
                "course" => $myBooking['course'],
            ];
            if ($myBooking['session_date'] > $date_now){
                $check_coming = true;
            }
        }

        return response($myBookingsGroup,201);
    }

    public function bookingsList($id,Request $request)
    {
        $id = $request->user()->roler_id == 1 ? $request->user()->id : $id;

        $myBookings = Booking::with(["timing","course"])
            ->whereIn("id",
                Booking::whereUser_id($id)->where("session_date", ">=", Carbon::now())->groupBy("booking_group_id")->selectRaw("MIN(id) id")->pluck("id"))
            ->get();
        $myBookings = $myBookings->map(function ($book)use ($request){
            $book['diff_time'] = Carbon::createFromFormat("Y-m-d H:i:s",$book['session_date'],
                $request->user()->id)->diffForHumans();
            return $book;
        });

        return response($myBookings,201);
    }

//    public function getBooking($myBookings,$timezone)
//    {
//        $allBookings = [];
//
//        foreach ($myBookings as $myBooking) {
//            $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking->start_date
//                ,$timezone);
//
//            $end_date = Carbon::createFromFormat('Y-m-d H:i:s',$myBooking->start_date
//                ,$timezone)->addDays(35);
//
//            $period = CarbonPeriod::create($start_date, $end_date);
//
//            $days = [];
//            $timingDays= $myBooking->timing->days;
//            $myBooking->time = Carbon::createFromFormat('Y-m-d H:i:s',
//                $myBooking->timing->time
//                ,$timezone);
//
//            foreach ($period as $item) {
//                $day = $item->format("l");
//                $coming = $item->format("Y-m-d ") . $myBooking->time->format("H:i");
//                if (in_array($day,$timingDays) && count($days) != 12){
//                    $days[] = [
//                        "date" => $item->format("Y-m-d"),
//                        "day" => $day,
//                        "date_time" =>$coming,
//                        "status" => ($coming < date("Y-m-d H:i") ? "expired" : "incoming"),
//                        "current" => ($coming == date("Y-m-d H:i") ? true : false),
//                        "coming" => ($coming > date("Y-m-d H:i") && !in_array(true,array_column($days,"coming")) ? true : false),
//                    ];
//                }
//            }
//            $myBooking->courseTimes = $days;
//            if (!$myBooking->expired_date){
//                $expiredBooking = Booking::find($myBooking->id);
//                $expiredBooking->expired_date = $days[count($days)-1]['date'] . " " . Carbon::parse($myBooking->time)->addHours(2)->format("H:i");
//                $expiredBooking->save();
//            }
//            $allBookings[] = $myBooking;
//        }
//
//        return $allBookings;
//    }

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

        foreach ($days as $key => $day) {
            Booking::create([
                "timing_id"=> $request->timing_id,
                "course_id"=> $request->course_id,
                "session_date"=> $day['date_time'],
                "booking_group_id"=>$booking_group_id,
                "session_num"=> $key+1,
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

    function coming_bookings(){
        $bookings_coming_id = Booking::groupBy("booking_group_id")
                                ->where("session_date",">",Carbon::now())
                                ->selectRaw("MIN(id) id")
                                ->pluck("id");
        $myBookings = Booking::with(["timing","course","user","meetings"])
            ->whereIn("bookings.id",$bookings_coming_id)
            ->get();

        $myBookings = $myBookings->map(function ($book){
            $book['meeting_date'] =  date("Y-m-d H:i",strtotime($book['session_date']));
            $book['meeting_date'] = str_replace(" ","T",$book['meeting_date']);
            return $book;
        });

        return response($myBookings,201);
    }

    function bookingsPresenting(Request $request)
    {
        if (!$request->user()->free_trail){
           $request->user()->update([ "free_trail" => "1" ]);
        }
        Booking::find($request->booking_id)->update([ "present" => "1" ]);

        return response(User::find($request->user()->id),201);
    }

    public function bookingsPayCheck($id,Request $request)
    {
        $bookingCheck = Booking::with(["timing","course"])
                         ->whereIdAndUser_id($id,$request->user()->id)
                         ->whereDoesntHave("payment")
                         ->first();
        if ($bookingCheck){
            return response($bookingCheck,201);
        }

        return response("",500);

    }
}
