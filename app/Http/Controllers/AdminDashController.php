<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    function index(){
        return view('admindashboard');
    }
}
