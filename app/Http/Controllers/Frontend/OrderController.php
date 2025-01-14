<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
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

        // if customer choose COD or not

        //if not COD--- then need pay through SSL commerz
        if($request->payment == 'online')
        {
            // pay with ssl
           
            $this->payNow($order);

        }


        session()->forget('cart');
        notify()->success('Order Place Success.');

        return redirect()->route('home');


    }

    public function payNow($order)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $order->total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order->id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $order->receiver_name;
        $post_data['cus_email'] =  $order->receiver_email;
        $post_data['cus_add1'] =  $order->receiver_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] =  $order->receiver_mobile_no;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }
}
