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
        $timings = Timing::whereRemoved(0)->get();

        $timings = $timings->map(function ($timing) use ($request){
            $timing['time'] = Carbon::createFromFormat('Y-m-d H:i:s',$timing['time']
                ,$request->user()->timezone);
            $timing['timeEdit'] = $timing['time']->format("H:i");
            return $timing;
        });

        return response($timings,201);
    }

    public function checkTimes(Request $request)
    {
//        $checkTimes = Booking::with("timing")
//            ->where("user_id",$request->user()->id)
//            ->where("course_id",$request->course_id)
//            ->get();
        $checkTimes = Booking::whereUser_idAndCourse_id($request->user()->id,$request->course_id)
                                ->where(function ($query){
                                    return $query
                                            ->where("session_date",">",Carbon::now());
                                })
                                ->pluck("timing_id");

        return response($checkTimes,201);
    }


    public function store(Request $request)
    {
        Timing::create([
            "days" => json_encode($request->days),
            "price" => $request->price,
            "time" => date("Y-m-d H:i:s"),
            "user_id" => $request->user()->id
        ]);
        return response("DONE",201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function show(Timing $timing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function edit(Timing $timing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timing $timing)
    {
        $timing->update([
            "days" => json_encode($request->days),
            "price" => $request->price,
            "time" => date("Y-m-d H:i:s"),
            "user_id" => $request->user()->id
        ]);
        return response($timing,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Timing::find($id)->update(["removed" => "1"]);
        return response("done",200);
    }
}
