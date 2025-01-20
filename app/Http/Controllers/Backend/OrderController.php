<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {

        $orders=Order::with('customer')->paginate(10);

        return view('backend.pages.orders.index',compact('orders'));
    }
}
