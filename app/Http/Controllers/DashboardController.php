<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $banners = Banner::all();
        return view('welcome', compact('categories', 'banners'));
    }
}
