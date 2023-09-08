<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseStudent;
use App\Models\Course;
use App\Models\Student;

class StudentController extends Controller
{
    public function admin(){
        $students = Student::simplePaginate(1);
        return view('adminstudent',['students'=>$students]);
    }

    public function index($id){
        $courses_id = $this->getStudentCoursesIds($id);

        $courses = Course::find($courses_id);

        $student = Student::find($id);

        return view('student',['courses'=>$courses,'student'=>$student]);
    }

    public function getStudentCoursesIds($id){
        $s = CourseStudent::all();
        $Sc = $s->where('student_id',$id);

        $courses_id = [];
        foreach ($Sc as $s) {
            array_push($courses_id,$s->course_id);
        }

        return $courses_id;
    }
}
