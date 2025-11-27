<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show_register(){
        return view('registerpage');
    }

    public function register_validate(Request $request){
        request()->validate([
            'namereg' => 'required',
            'usernamereg' => 'required|unique:users,username',
            'emailreg' => 'required|email|unique:users,email',
            'passwordreg' => 'required|min:8',
            'conpasswordreg' => 'required|same:passwordreg',
        ]);


            $datareg['name'] = $request->namereg;
            $datareg['username'] = $request->usernamereg;
            $datareg['email'] = $request->emailreg;
            $datareg['password'] = $request->conpasswordreg;
       
        User::create($datareg);


        $datalog=[
            'username'=>$request->usernamereg,
            'password'=>$request->conpasswordreg,
        ];


        if (Auth::attempt($datalog)){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('/')->with('error','Registrasi Gagal, Terdapat kesalahan pada username atau password');
        }
   
    }


}
