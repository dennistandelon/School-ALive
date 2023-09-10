<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Lecturer;
use App\Models\Student;

class CourseController extends Controller
{

    public function adminUp($id){
        $course = Course::find($id);

        $lecturers = Lecturer::all();
        $students = Student::all();

        return view('update',['course'=>$course,'lecturers'=>$lecturers,'students'=>$students]);
    }

    public function admin(){
        $courses = Course::simplePaginate(5);
        $lecturers = Lecturer::all();

        return view('admin',['courses'=>$courses,'lecturers'=>$lecturers]);
    }

    public function adminSearch(Request $req){
        $courses = Course::where('title','LIKE',"%$req->search%")->simplePaginate(5);
        $lecturers = Lecturer::all();

        return view('admin',['courses'=>$courses,'lecturers'=>$lecturers]);
    }

    public function createCourse(Request $req){
        $newCourse = new Course();
        $newCourse->title = $req->title;
        $newCourse->desc = $req->desc;
        $newCourse->lecturer_id = $req->lecturer_id;
        $newCourse->save();

        return redirect()->back();
    }

    public function updateCourse(Request $req){

        $reqCourse = Course::find($req->course_id);
        $reqCourse->title = $req->title;
        $reqCourse->desc = $req->desc;
        $reqCourse->lecturer_id = $req->lec;
        $reqCourse->save();

        return redirect()->back();
    }

    public function deleteCourse($id){
        $course = Course::find($id);

        if(isset($course)){
            $course->delete();
        }

        $course_link = CourseStudent::all();

        foreach ($course_link as $link) {
            if($link->course_id == $id){
                $link->delete();
            }
        }

        return redirect()->back();
    }

    public function coursePage($id){

        $course = Course::find($id);
        $lecturer = Lecturer::find($course->lecturer_id);

        return view('course',['course'=>$course,'lecturer'=>$lecturer]);
    }
}
