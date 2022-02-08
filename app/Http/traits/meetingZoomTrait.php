<?php
namespace App\Http\traits;


use Carbon\Carbon;
use MacsiDigital\Zoom\Facades\Zoom;

trait meetingZoomTrait
{
    public function createMeetingZoom($request)
    {

        $zoomUser = Zoom::user()->first();

        $meetingZoom = Zoom::meeting()->make([
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => "0123456",
            'type' => 8,
            'start_time' => new Carbon($request->start_date),
            "timezone" => "Africa/Cairo"
        ]);

        $meetingZoom->recurrence()->make([
            'type' => 2,
            'repeat_interval' => 1,
            'weekly_days' => "0",
            'end_times' => 0
        ]);

        $meetingZoom->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'recurrence' => false,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);


        return $zoomUser->meetings()->save($meetingZoom);


    }
}
