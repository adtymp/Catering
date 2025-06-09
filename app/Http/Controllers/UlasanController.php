<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{

    public function index(){
        $categories = Category::all();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;


        return view('ulasan',compact('categories', 'cartCount' ));
    }
}
