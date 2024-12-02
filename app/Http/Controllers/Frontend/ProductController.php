<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {

        $konika=Category::all();
        return view('frontend.pages.products',compact('konika'));
        
    }
}
