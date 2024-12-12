<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {

        $products=Product::all();
        return view('frontend.pages.products',compact('products'));
        
    }


    public function view($product_id)
    {
       $singleProduct=Product::find($product_id);
       
       return view('frontend.pages.product_view',compact('singleProduct'));
    }
}
