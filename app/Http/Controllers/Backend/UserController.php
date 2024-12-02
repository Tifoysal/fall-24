<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        return view('backend.pages.login');    
    }

    public function doLogin(Request $request)
    {

       //validation

       $validation=Validator::make($request->all(),[
        'email'=>'required',
        'password'=>'required|min:6',
       ]);

       if($validation->fails()){
        
        return redirect()->back();
       }

       $credentials=$request->except('_token');

       if(Auth::attempt($credentials))
       {


        //message

        return redirect()->route('dashboard');
       }

       //message
       return redirect()->back();


        
    }

    public function signout()
    {
        Auth::logout();

        return redirect()->route('login');
        
    }
}
