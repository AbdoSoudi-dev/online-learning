<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class,"booking_meeting");
    }

}
