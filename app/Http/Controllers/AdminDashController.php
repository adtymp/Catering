<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    function index(){
        $product = Product::all()->count();

        return view('admindashboard', compact('product'));
    }
}
