<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    function Details(){
        return $this->hasMany(Detail::class,'course_id','id');
    }

    function Students(){
        return $this->belongsToMany(Student::class,'course_students', 'course_id','student_id');
    }

    function Lecturer(){
        return $this->belongTo(Lecturer::class,'lecturer_id','id');
    }
}
