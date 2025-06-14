<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;
    protected $table = 'internships'; // Replace with your table name
    protected $fillable = ['student_id','student_name','email', 'company_name', 'start_date', 'end_date', 'status'];

}
