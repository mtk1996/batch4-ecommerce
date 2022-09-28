<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductApi extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->with('brand', 'color', 'review.user', 'category')->first();
        return response()->json($product);
    }

    public function addToCart()
    {
        $product = Product::where('slug', request()->product_slug)->first();

        ProductCart::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'total_quantity' => 1,
        ]);
        $cart_count = ProductCart::where('user_id', auth()->id())->count();
        return response()->json([
            'message' => "added_to_cart",
            'cart_count' => $cart_count
        ]);
    }

    public function makeReview(Request $request)
    {
        $product_id = $request->product_id;
        $review = $request->review;
        $rating = $request->rating;
        $user_id = auth()->id();
        $review =  ProductReview::where('id', $product_id)->create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'review' => $review,
            'rating' => $rating
        ]);

        $reviewed =  ProductReview::where('id', $review->id)->with('user')->first();
        return response()->json($reviewed);
    }

    public function carts()
    {
        $cart = ProductCart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        return response()->json($cart);
    }

    public function changeCart($id)
    {
        ProductCart::where('id', $id)->update([
            'total_quantity' => request()->totalQty,
        ]);
        return 'success';
    }

    public function makeOrder()
    {
        $carts = ProductCart::where('user_id', auth()->id())->get();
        foreach ($carts as $c) {
            Order::create([
                'user_id' => auth()->id(),
                'product_id' => $c->product_id,
                'total_quantity' => $c->total_quantity,
                'payment' => request()->payment,
                'address' => request()->address,
                'phone' => request()->phone,
            ]);
        }
        ProductCart::where('user_id', auth()->id())->delete();
        return 'success';
    }
}
