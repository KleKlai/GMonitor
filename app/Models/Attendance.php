<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer', 'visibility'
    ];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class);
    }
}
