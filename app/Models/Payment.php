<?php

namespace App\Models;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function booking(){
        return $this->belongsTo(Booking::class,"booking_group_id","booking_group_id");
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
