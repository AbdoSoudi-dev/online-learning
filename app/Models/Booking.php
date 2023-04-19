<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\Timing;
use App\Models\Course;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


class Booking extends Model
{
    use HasFactory;
    protected $guarded =[];

    protected $appends = ['diff_time','meeting_date'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function timing(){
        return $this->belongsTo(Timing::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function meetings()
    {
        return $this->belongsToMany(Meeting::class,"booking_meeting");
    }
    public function payment(){
        return $this->belongsTo(Payment::class,"booking_group_id","booking_group_id");
    }

    public function getDiffTimeAttribute()
    {
        return $this->session_date ? Carbon::createFromFormat("Y-m-d H:i:s",$this->session_date,
            auth()->user()->timezone)->diffForHumans() : "";
    }
    public function getMeetingDateAttribute()
    {
        return $this->session_date ?
            str_replace(" ","T", Carbon::parse($this->session_date)->format("Y-m-d H:i")) : "";
    }



}
