<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $carts = Cart::where('user_id', Auth::id())->get();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('cartroom', compact('categories', 'carts', 'cartCount'));
    }
    public function addCart(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
            'product' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'slug' => 'required|exists:products,slug',
        ]);

        $product = Product::findOrFail($request->product);

        if ($request->quantity < $product->minPax) {
            return back()->withErrors(['quantity' => 'Minimal pemesanan produk ini adalah ' . $product->minPax]);
        }

        $cart = new Cart();
        $cart->user_id = $request->user;
        $cart->product_id = $request->product;
        $cart->quantity = $request->quantity;

        if ($cart->save()) {
            return redirect()->route('detailproduct', ['slug' => $request->slug])->with('success', 'Produk "' . $cart->product->name . '" berhasil ditambahkan ke Keranjang.');
        } else {
            return back()->withErrors('Gagal menyimpan banner');
        }
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);
        });
    }

    public function updateQuantity(Cart $cart, Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update(['quantity' => $validated['quantity']]);

        return response()->json([
            'success' => true,
            'new_price' => $cart->product->price * $cart->quantity
        ]);
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
