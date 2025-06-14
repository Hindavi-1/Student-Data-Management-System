<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseWorkshop extends Model
{
    use HasFactory;
    protected $table='courses_workshops';
    protected $fillable = [
        'user_id', 'title', 'organizer', 'start_date', 'end_date', 
        'type', 'mode', 'skills_acquired', 'certificate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
