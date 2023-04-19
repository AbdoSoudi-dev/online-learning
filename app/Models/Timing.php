<?php

namespace App\Models;

use App\Scopes\NotRemovedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timing extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new NotRemovedScope());
    }

    public function getDaysAttribute($value)
    {
        return json_decode($value);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
