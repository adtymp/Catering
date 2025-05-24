<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $addresss = address::where('user_id', Auth::id())->get();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('profile', compact('categories', 'addresss', 'cartCount', 'addresses'));
    }
}