<?php

namespace App\Http\Controllers;

use App\Http\traits\meetingZoomTrait;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    use meetingZoomTrait;

    public function createMeeting(Request $request)
    {
        $zoomMeeting = $this->createMeetingZoom($request);

        $meeting = Meeting::create([
           "user_id" => $request->user()->id,
            "meeting_id" => $zoomMeeting->id,
            "topic" => $request->topic,
            "start_at" => $request->start_at,
            "duration" => $request->duration,
            "password" => $zoomMeeting->password,
            "start_url" => $zoomMeeting->start_url,
            "join_url" => $zoomMeeting->join_url
        ]);

        $meeting->bookings()->attach($request->bookings);

        return response("Done",201);
    }

    public function getMeetings()
    {
        $meetings = Meeting::with(["bookings"=>function($query){
            $query->with("user");
        }])->latest()->get();

        return $meetings;
    }
}
