<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Timing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimingController extends Controller
{

    public function index(Request $request)
    {
        $timings = Timing::all();

        $timings = $timings->map(function ($timing) use ($request){
            $timing['time'] = Carbon::createFromFormat('Y-m-d H:i:s',$timing['time']
                ,$request->user()->timezone);
            $timing['timeEdit'] = $timing['time']->format("H:i");
            return $timing;
        });

        return $timings;
    }

    public function checkTimes(Request $request)
    {
        return Booking::whereUser_idAndCourse_id($request->user()->id,$request->course_id)
                ->where(function ($query){
                    return $query->where("session_date",">",Carbon::now());
                })
                ->pluck("timing_id");
    }

    public function store(Request $request)
    {
        Timing::create([
            "days" => json_encode($request->days),
            "price" => $request->price,
            "time" => date("Y-m-d H:i:s"),
            "user_id" => $request->user()->id
        ]);
        return true;
    }

    public function update(Request $request, Timing $timing)
    {
        $timing->update([
            "days" => json_encode($request->days),
            "price" => $request->price,
            "time" => date("Y-m-d H:i:s"),
            "user_id" => $request->user()->id
        ]);
        return true;
    }

    public function destroy($id)
    {
        Timing::find($id)->update(["removed" => "1"]);
        return true;
    }
}
