<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Function Login
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Login berhasil, redirect ke halaman dashboard
            return redirect()->intended('dashboard');
        } else {
            // Login gagal
            return redirect()->back()->withErrors(['email' => 'Username dan password tidak sesuai'])->withInput();
        }
    }


    function regis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // confirmed = password_confirmation
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            return redirect()->route('dashboard');
        }
        else{
            return back()->withErrors('Gagal menyimpan User');
        }
    }
}
