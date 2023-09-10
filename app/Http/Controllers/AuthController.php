<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Lecturer;
use App\Models\Student;

class AuthController extends Controller
{

    public function loginPage(){
        return view('login');
    }

    public function profile(){
        $status = Auth::user()->status;
        $id = Auth::user()->status_id;

        $person = [];
        if($status == 'lecturer'){
            $person = Lecturer::find($id);
        } else{
            $person = Student::find($id);
        }

        return view('myprofile',['person'=>$person,'stats'=>$status]);
    }

    public function profileUp(Request $req){
        $status = Auth::user()->status;
        $id = Auth::user()->status_id;

        $person = [];
        if($status == 'lecturer'){
            $person = Lecturer::find($id);

            $image = $req->file('image');
            if(isset($req->fullname)){
                $person->fullname = $req->fullname;
            }

            if(isset($image)){
                Storage::delete('public/'.$person->imageurl);

                $imagename = time().'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('public/images/lecturers',$image, $imagename);

                $person->imageurl = 'images/lecturers/'.$imagename;
            }

            if(isset($req->specialization)){
                $person->specialization = $req->specialization;
            }
            $person->save();
        } else{
            $person = Student::find($id);

            $image = $req->file('image');
            if(isset($req->fullname)){
                $person->fullname = $req->fullname;
            }

            if(isset($image)){
                Storage::delete('public/'.$person->imageurl);

                $imagename = time().'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('public/images/students',$image, $imagename);

                $person->imageurl = 'images/students/'.$imagename;
            }

            $person->save();
        }

        return redirect()->back();
    }

    public function login(Request $req){
        $user = [
            'email' => $req->email,
            'password' => $req->pass
        ];

        if(Auth::attempt($user)){
            $role = Auth::user()->status;
            if($role == 'admin'){
                return redirect('/admin');
            } else if($role == 'lecturer'){
                return redirect('/lecturer/'.Auth::user()->status_id);
            } else if($role == 'student'){
                return redirect('/student/'.Auth::user()->status_id);
            }
        }

        return redirect('/');

    }

    public function home(){
        $role = Auth::user()->status;

        if(isset($role)){
            if($role == 'admin'){
                return redirect('/admin');
            } else if($role == 'lecturer'){
                return redirect('/lecturer/'.Auth::user()->status_id);
            } else if($role == 'student'){
                return redirect('/student/'.Auth::user()->status_id);
            }
        }

        return redirect('/');
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
