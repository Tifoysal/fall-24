<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
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


    public function viewCart()
    {

    
        $cartData=Session::get('cart') ?? [];


        return view('frontend.pages.cart_view',compact('cartData'));    
    }


    public function checkout(){

        $cartData=Session::get('cart') ?? [];
        return view('frontend.pages.checkout',compact('cartData'));
    }

    public function placeOrder(Request $request){


        // dd($request->all());
        //validation
        //order-single data



        $order=Order::create([
            'customer_id'=>auth('customerGuard')->user()->id,
            'receiver_name'=>$request->receiver_name,
            'receiver_address'=>$request->address,
            'receiver_email'=>$request->receiver_email,
            'receiver_mobile_no'=>$request->mobile_no,
            'payment_type'=>$request->payment,
            'sub_total'=>$request->subtotal,
            'total_amount'=>$request->subtotal + 70,
        ]);

        //Order Details - cart item - multiple
        $myCart=Session()->get('cart');

        foreach($myCart as $cart)
        {
          
            OrderDetails::create([
                'order_id'=>$order->id,
                'product_id'=>$cart['id'],
                'quanity'=>$cart['quantity'],
                'unit_price'=>$cart['price'],
                'subtotal'=>$cart['subtotal'],
            ]);

        }


        session()->forget('cart');
        notify()->success('Order Place Success.');

        return redirect()->route('home');


    }
}
