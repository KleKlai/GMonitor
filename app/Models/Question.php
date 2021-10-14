<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'visibility'
    ];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
