<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $categories = Category::all();
        $banners = Banner::all();

        $query = Product::query();

        // Filter by kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil produk hasil filter
        $products = $query->get();

        $editBanner = null;
        $editCategory = null;
        $editProduct = null;

        if (session()->has('editBannerId')) {
            $editBanner = Banner::find(session('editBannerId'));
        }
        if (session()->has('editCategoryId')) {
            $editCategory = Category::find(session('editCategoryId'));
        }
        if (session()->has('editProductId')) {
            $editProduct = Product::find(session('editProductId'));
        }


        return view('productroom', compact('categories', 'banners', 'products', 'editBanner', 'editCategory', 'editProduct'));
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
            return redirect()->route('productroom')->with('success', 'Produk "' . $product->name . '" berhasil ditambahkan.');
        } else {
            return back()->withErrors('Gagal menyimpan banner');
        }
    }
    public function editProduct($id)
    {
        return redirect()->route('productroom')->with('editProductId', $id);
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kategori' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->deskripsi = $request->deskripsi;
        $product->price = $request->price;
        $product->category_id = $request->kategori;

        if ($request->hasFile('image')) {
            $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imageProduct = $request->file('image')->storeAs('products', $originalName, 'public');
            $product->image = $imageProduct;
        }


        if ($product->save()) {
            return redirect()->route('productroom');
        } else {
            return back()->withErrors('Gagal menyimpan Produk');
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('productroom');
    }

    public function searchProduct(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('productroom', compact('products', 'categories'));
    }
}
