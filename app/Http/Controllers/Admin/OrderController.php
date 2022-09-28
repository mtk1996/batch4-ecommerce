<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        $order =  Order::with('product');
        if (request()->status) {
            $order->where('status', request()->status);
        }
        $order = $order->paginate(2);
        return view('admin.order.all', compact('order'));
    }

    public function changeStatus($status)
    {
        Order::where('id', request()->id)->update([
            'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Order Changed!');
    }
}
