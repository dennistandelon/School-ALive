<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerController extends Controller
{
    public function admin(){
        $lecturers = Lecturer::simplePaginate(1);
        return view('adminlecturer',['lecturers'=>$lecturers]);
    }
}
