<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getDaysAttribute($value)
    {
        return json_decode($value);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
