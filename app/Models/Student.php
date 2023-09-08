<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    function Courses(){
        return $this->belongsToMany(Course::class,"course_students","student_id","course_id");
    }

}
