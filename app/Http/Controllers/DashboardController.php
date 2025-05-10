<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $banners = Banner::all();
        $products = Product::with('category')->get();

        return view('welcome', compact('categories', 'banners', 'products'));
    }

    public function filterSearch(Request $request)
    {
        $categories = Category::all();
        $banners    = Banner::all();

        $productsQuery = Product::with('category');

        if ($request->filled('query')) {
            $productsQuery->where('name', 'like', '%' . $request->query('query') . '%');
        }

        switch ($request->query('filter')) {
            case 'under-15000':
                $productsQuery->where('price', '<', 15000);
                break;

            case '15-25k':
                $productsQuery->whereBetween('price', [15000, 25000]);
                break;

            case '25-50k':
                $productsQuery->whereBetween('price', [25000, 50000]);
                break;

        }

        $products = $productsQuery->get();

        return view('showall', compact('categories', 'banners', 'products'));
    }
    function detailProduct($id){
        $categories = Category::all();
        $product = product::find($id);

        return view('detailproduct', compact('categories', 'product'));
    }
}
