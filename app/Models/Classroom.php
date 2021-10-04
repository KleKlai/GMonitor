<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->user_id = Auth::user()->id;
            $query->token   = Str::random(64);
        });
    }

}
