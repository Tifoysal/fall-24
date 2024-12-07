<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products()
    {
        return view('backend.pages.products');    
    }

    public function productCreate(){
        return view('backend.pages.product.create');
    }

    public function store(Request $request){

        //validation

        $val=Validator::make($request->all(),[
            'product_name'=>'required',
            'product_price'=>'required',
            'product_quantity'=>'required',

        ]);

        if($val->fails())
        {
            notify()->error($val->getMessageBag());
            return redirect()->back();
        }


        Product::create([
            'name'=>$request->product_name,
            'description'=>$request->description,
            'quantity'=>$request->product_quantity,
            'price'=>$request->product_price,
            
        ]);
        return redirect()->back();

    }
}
