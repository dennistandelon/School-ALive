<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Lecturer;
use App\Models\User;

class LecturerController extends Controller
{
    public function admin(){
        $lecturers = Lecturer::simplePaginate(1);
        return view('adminlecturer',['lecturers'=>$lecturers]);
    }

    public function adminUp($id){
        $person = Lecturer::find($id);
        $type = 'lecturer';
        return view('profile',['person'=>$person,'type'=>$type]);
    }

    public function insertLecturer(Request $req){

        $image = $req->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        Storage::putFileAs('public/images/lecturers',$image, $imagename);

        $lecturer = new Lecturer();
        $lecturer->fullname = $req->fullname;
        $lecturer->imageurl = 'images/lecturers/'.$imagename;
        $lecturer->specialization = $req->special;
        $lecturer->save();

        $user = new User();
        $user->name = $lecturer->fullname;
        $user->email = strtolower(str_replace(' ','.',$lecturer->fullname)).'@schoolalive.edu';
        $user->password = bcrypt('schoolalive123');
        $user->status = 'lecturer';
        $user->status_id = $lecturer->id;

        $user->save();

        return redirect()->back();
    }

    public function deleteLecturer($id){
        $lecturer = Lecturer::find($id);
        $lec_user = Lecturer::where('status','lecturer')->where('status_id',$id)->get($id);

        $lec_user = Lecturer::find($lec_user->id);

        if(isset($lecturer)){
            $storagelink = $lecturer->imageurl;

            Storage::delete('public/'.$storagelink);
            $lecturer->delete();
        }

        if(isset($lec_user)){
            $lec_user->delete();
        }

        return redirect()->back();
    }

    public function index($id){

        $lecturer = Lecturer::find($id);

        return view('lecturer',['lecturer'=>$lecturer]);
    }
}
