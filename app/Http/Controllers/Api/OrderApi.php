<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApi extends Controller
{
    public function all()
    {
        $order =  Order::latest()->with('product')->paginate(2);
        return response()->json($order);
    }
}
