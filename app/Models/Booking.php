<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\Timing;
use App\Models\Course;


class Booking extends Model
{
    use HasFactory;
    protected $guarded =[];

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

}
