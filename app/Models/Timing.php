<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTimeAttribute($value)
    {
//        $timezone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, "US");
//
//        return $timezone;

//        $time = Carbon::parse($value)->format('g:i A');
        return Carbon::createFromFormat('Y-m-d H:i:s',$value,"PDT");
//        return date("Y-m-d H:i:s",strtotime($value));
    }
    public function getDaysAttribute($value)
    {
        return json_decode($value);
    }

}
