<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products()
    {
        $products=Product::all();
        return view('backend.pages.products',compact('products'));    
    }

    public function productCreate(){
        return view('backend.pages.product.create');
    }

    public function store(Request $request){
        //validation
       

        $val=Validator::make($request->all(),[
            'product_name'=>'required',
            'image'=>'required',//|mimes:jpg,png|size:1024
            'product_price'=>'required',
            'product_quantity'=>'required',

        ]);

        if($val->fails())
        {
            notify()->error($val->getMessageBag());
            return redirect()->back();
        }


        //file upload
        $fileName='';
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
             
            //first generate unique name
            $fileName=date('Ymdhis').'.'.$file->getClientOriginalExtension();

            //Store file into filesystem
            $file->storeAs('/backend/uploads',$fileName);
            
        }


        Product::create([
            'name'=>$request->product_name,
            'description'=>$request->description,
            'quantity'=>$request->product_quantity,
            'price'=>$request->product_price,
            'image'=>$fileName
            
        ]);
        return redirect()->back();

    }

}
