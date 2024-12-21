<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    
    public function registrationForm()
    {
        return view('frontend.pages.registration');
    }


    public function registration(Request $request)
    {
       //validation

       $validate=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed',
            'mobile_number'=>'required|min:11|max:11'
       ]);

       if ($validate->fails())
       {
        
        notify()->error($validate->getMessageBag());

        return redirect()->back();


       }
      

       //file handle
       $fileName='';
       if($request->hasFile('image'))
       {
        $image=$request->file('image');
        //generate name
        $fileName=date('Ymdhis').'.'.$image->getClientOriginalExtension();
        //now store image in local filesystem
        $image->storeAs('/frontend/uploads',$fileName);
       }
      

       //query

       Customer::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'address'=>$request->address,
        'mobile'=>$request->mobile,
        'image'=>$fileName
       ]);

       notify()->success('Customer Registration Success.');
       return redirect()->route('home');
    }
}
