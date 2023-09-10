<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\CourseStudent;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function admin(){
        $students = Student::simplePaginate(5);
        return view('adminstudent',['students'=>$students]);
    }

    public function adminAs($id){
        $st_user = User::all()->where('status','student')->where('status_id',$id)->firstOrFail();


        $user_id = $st_user->id;

        Auth::logout();
        Auth::loginUsingId($user_id);

        return redirect('/home');
    }

    public function adminSearch(Request $req){
        $students = Student::where('fullname','LIKE',"%$req->search%")->simplePaginate(5);

        return view('adminstudent',['students'=>$students]);
    }

    public function insertStudent(Request $req){

        $image = $req->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        Storage::putFileAs('public/images/students',$image, $imagename);

        $student = new Student();
        $student->fullname = $req->fullname;
        $student->imageurl = 'images/students/'.$imagename;
        $student->save();

        $user = new User();
        $user->name = $student->fullname;
        $user->email = strtolower(str_replace(' ','.',$student->fullname)).'@schoolalive.edu';
        $user->password = bcrypt('schoolalive123');
        $user->status = 'student';
        $user->status_id = $student->id;

        $user->save();

        return redirect()->back();
    }

    public function deleteStudent($id){
        $student = Student::find($id);
        $st_user = User::all()->where('status','student')->where('status_id',$id)->firstOrFail();

        $st_user = User::find($st_user->id);

        if(isset($student)){
            $storagelink = $student->imageurl;

            Storage::delete('public/'.$storagelink);
            $student->delete();
        }

        if(isset($st_user)){
            $st_user->delete();
        }

        $course_link = CourseStudent::all();

        foreach ($course_link as $link) {
            if($link->student_id == $id){
                $link->delete();
            }
        }

        return redirect()->back();
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

    public function assignCourse(Request $req){

        if(!isset($req->students)){
            return redirect()->back();
        }

        if(!is_array($req->students)){

            $r = new CourseStudent();

            $r->student_id = $req->students;
            $r->course_id = $req->cid;
            $r->save();

            return redirect()->back();
        }

        foreach ($req->students as $st) {
            $r = new CourseStudent();

            $r->student_id = $st;
            $r->course_id = $req->cid;
            $r->save();
        }

        return redirect()->back();
    }

    public function unassignCourse($cid,$sid){

        $data = CourseStudent::where('student_id',$sid)->where('course_id',$cid)->firstOrFail();

        if(isset($data)){
            $data->delete();
        }

        return redirect()->back();
    }
}
