<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function show_login(){
        return view('loginpage');
    }

    public function dashboard(){
        return view('dashboard');
    }


    public function login_validate(Request $request)
    {

        $datalog=[
            'username'=>$request->usernamelgn,
            'password'=>$request->passwordlgn,
        ];


        if (Auth::attempt($datalog)){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('/')->with('error','Login Gagal, Terdapat kesalahan pada username atau password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('/');
    }


}
