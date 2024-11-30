<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand()
    {
        
        return view('backend.pages.brand');
    }
}
