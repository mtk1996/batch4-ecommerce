<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeApi extends Controller
{
    public function home()
    {
        $category = Category::take(8)
            ->withCount('product')
            ->latest()
            ->get();
        $product = Category::take(3)->with(['product' => function ($q) {
            $q->take(6);
        }])->get();

        $featureProduct = Product::where('is_feature', 'yes')->take(3)->get();

        return response()->json([
            'category' => $category,
            'product' => $product,
            'feature_product' => $featureProduct
        ]);
    }
}
