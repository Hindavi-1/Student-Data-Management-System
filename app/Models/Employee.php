<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name', 'email', 'address', 'date_of_joining', 'gender', 'status',
    ];
    

}



