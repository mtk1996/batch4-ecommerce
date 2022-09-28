<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function allProduct()
    {
        $category = Category::withCount('product')->get();
        $color = Color::all();
        $brand = Brand::all();
        $product = Product::latest();

        // filter category
        if ($category_slug = request()->category) {
            $categoryData = Category::where('slug', $category_slug)->first();
            if (!$categoryData) {
                return redirect()->back()->with('error', 'Category Not Found');
            }
            $product->where('category_id', $categoryData->id);
        }
        //filter brand
        if ($brand_slug = request()->brand) {
            $brandData = Brand::where('slug', $brand_slug)->first();
            if (!$brandData) {
                return redirect()->back()->with('error', 'Brand Not Found');
            }
            $product->where('brand_id', $brandData->id);
        }

        //color
        if ($color_slug = request()->color) {
            $colorData = Color::where('slug', $color_slug)->first();
            if (!$colorData) {
                return redirect()->back()->with('error', 'Color Not Found');
            }
            $product->whereHas('color', function ($q) use ($colorData) {
                $q->where('product_color.color_id', $colorData->id);
            });
        }

        //filter by name
        if ($name = request()->name) {
            $product->where('name', 'like', "%$name%");
        }
        $product = $product->paginate(6);

        return view('all-product', compact('category', 'color', 'brand', 'product'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect('/')->with('error', 'Product Not Found');
        }
        $category = Category::withCount('product')->get();
        return view('product-detail', compact('category', 'slug'));
    }


    public function profile()
    {
        return view('profile');
    }
}
