<?php

namespace App\Models;

use App\Scopes\NotRemovedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ["title","image","description","short_desc","price","user_id"];

    protected static function booted()
    {
        static::addGlobalScope(new NotRemovedScope());
    }
}
