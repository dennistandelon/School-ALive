<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('student',['courses'=>$courses]);
    }

    public function adminUp($id){
        $course = Course::find($id);
        return view('update',['course'=>$course]);
    }

    public function admin(){
        $courses = Course::simplePaginate(1);
        return view('admin',['courses'=>$courses]);
    }

    public function adminSearch(Request $req){
        $courses = Course::where('title','LIKE',"%$req->search%")->simplePaginate(1);

        return view('admin',['courses'=>$courses]);
    }

    public function createCourse(Request $req){
        $newCourse = new Course();
        $newCourse->title = $req->title;
        $newCourse->desc = $req->desc;
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

        return redirect()->back();
    }
}
