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

    public function admin(){
        $courses = Course::all();
        return view('admin',['courses'=>$courses]);
    }



    public function createCourse(Request $req){
        $newCourse = new Course();
        $newCourse->title = $req->title;
        $newCourse->desc = $req->desc;
        $newCourse->save();

        return redirect()->back();
    }


}
