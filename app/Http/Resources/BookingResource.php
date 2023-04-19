<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookingResource extends JsonResource
{

    private $check_coming = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date_now = Carbon::createFromFormat('Y-m-d H:i:s',now(),$request->user()->timezone);
        $session_date = $lecture_start = Carbon::createFromFormat('Y-m-d H:i:s',$this->session_date
            ,$request->user()->timezone);

        $lecture_end = $session_date->addMinutes($this->duration);

        $bookingJson = [
            "id" => $this->id,
            "present" => $this->present,
            "course_id" => $this->course_id,
            "booking_group_id" => $this->booking_group_id,
            "session_date" => $session_date->format("Y-m-d"),
            "session_time" => $this->session_date,
            "day" => $session_date->format("l"),
            "status" => ($this->session_date < $date_now ? "expired" : "incoming"),
            "current" => ($date_now >= $lecture_start && $date_now <= $lecture_end ? true : false),
            "coming" =>($this->session_date > $date_now && !$this->check_coming &&
            !($date_now >= $lecture_start && $date_now <= $lecture_end) ? true : false),
            "timing" => $this->timing,
            "course" => $this->course,
            "duration" => $this->duration,
            "meeting" => $this->meetings
        ];
        if ($this->session_date > $date_now){
            $this->check_coming = true;
        }
        return $bookingJson;

    }
}
