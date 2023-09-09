<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\CourseStudent;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function admin(){
        $students = Student::simplePaginate(1);
        return view('adminstudent',['students'=>$students]);
    }

    public function adminUp($id){
        $person = Student::find($id);
        $type = 'student';
        return view('profile',['person'=>$person,'type'=>$type]);
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
        $st_user = User::all()->where('status','student')->where('status_id',$id)->get($id);

        $st_user = User::find($st_user->id);

        if(isset($student)){
            $storagelink = $student->imageurl;

            Storage::delete('public/'.$storagelink);
            $student->delete();
        }

        if(isset($st_user)){
            $st_user->delete();
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
        $r = new CourseStudent();

        $r->student_id = $req->sid;
        $r->course_id = $req->cid;

        $r->save();

        return redirect()->back();
    }
}
