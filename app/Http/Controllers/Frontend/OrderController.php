<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function addToCart($product_id)
    {

        $myCart=Session::get('cart');
       
        if(empty($myCart))
        {
            //add to cart

            $product=Product::find($product_id);

            // $cart[$product->id]
            $cartArray[$product_id]=[
                'id'=>$product->id,
                'name'=>$product->name,
                'image'=>$product->image,
                'price'=>$product->price,
                'quantity'=>1,
                'subtotal'=>$product->price * 1
            
            ];

            Session::put('cart',$cartArray);

           notify()->success('Product Added to Cart');
           return redirect()->back();

            // dd("vai cart e kichu nai");
        }

        if(array_key_exists($product_id,$myCart))
        {
            //step 2: quantity increase

            $myCart[$product_id]['quantity']= $myCart[$product_id]['quantity'] + 1;
            $myCart[$product_id]['subtotal']= $myCart[$product_id]['price']  * $myCart[$product_id]['quantity'];

            Session::put('cart',$myCart);

            notify()->success('Quantity Updated.');

            return redirect()->back();

           

        }else{

            //step 3: cart not empty but new product- add to cart

            $product=Product::find($product_id);

            // $cart[$product->id]
            $myCart[$product_id]=[
                'id'=>$product->id,
                'name'=>$product->name,
                'image'=>$product->image,
                'price'=>$product->price,
                'quantity'=>1,
                'subtotal'=>$product->price * 1
            
            ];

            Session::put('cart',$myCart);

           notify()->success('Product Added to Cart');
           return redirect()->back();
        }
       

       
    }
}
