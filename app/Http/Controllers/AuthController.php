<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginPage(){
        return view('login');
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

        return 'Login Failed';

    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
