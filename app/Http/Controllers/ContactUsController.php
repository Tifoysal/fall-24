<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    
    public function showContactUs(){
       
        return view('pages.contact');
    }
}
