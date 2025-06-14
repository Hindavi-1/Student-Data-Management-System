<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['student_id', 'title', 'description', 'date_awarded', 'type'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}

