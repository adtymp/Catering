<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $banners = Banner::all();
        $products = Product::with('category')->get();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('welcome', compact('categories', 'banners', 'products', 'cartCount'));
    }

    public function filterSearch(Request $request)
    {
        $categories = Category::all();
        $banners    = Banner::all();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $productsQuery = Product::with('category');
        

        if ($request->filled('query')) {
            $productsQuery->where('name', 'like', '%' . $request->query('query') . '%');
        }

        switch ($request->query('filter')) {
            case 'under-15000':
                $productsQuery->where('price', '<=', 15000);
                break;

            case '15-25k':
                $productsQuery->whereBetween('price', [15000, 25000]);
                break;

            case '25-50k':
                $productsQuery->whereBetween('price', [25000, 50000]);
                break;

        }

        $products = $productsQuery->get();

        return view('showall', compact('categories', 'banners', 'products', 'cartCount'));
    }
    function detailProduct($slug){
        $categories = Category::all();
        $product = product::where('slug', $slug)->firstOrFail();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('detailproduct', compact('categories', 'product', 'cartCount'));
    }
}
