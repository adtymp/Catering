<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $banners = Banner::all();
        $products = Product::all();

        $editBanner = null;
        $editCategory = null;
        
        if (session()->has('editBannerId')) {
            $editBanner = Banner::find(session('editBannerId'));
        }
        if(session()->has('editCategoryId')){
            $editCategory = Category::find(session('editCategoryId'));
        }
        

        return view('productroom', compact('categories', 'banners', 'products', 'editBanner', 'editCategory'));
    }

    function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kategori' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imageProduct = $request->file('image')->storeAs('products', $originalName, 'public');
        } else {
            return back()->withErrors(['image' => 'File image tidak ditemukan.']);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->deskripsi = $request->deskripsi;
        $product->price = $request->price;
        $product->category_id = $request->kategori;
        $product->image = $imageProduct;

        if ($product->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan banner');
        }
    }
}
