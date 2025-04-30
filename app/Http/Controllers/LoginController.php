<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\CekLogin;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'min:8', new CekLogin($request)]
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Session::put('loginStatus', true);

            if ($user->role == "admin") {
                return redirect()->intended(route('admindashboard'));
            } elseif ($user->role == "customer") {
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Maaf, Ulangi inputan'])->withInput();
            }
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
            return redirect()->route('login');
        } else {
            return back()->withErrors('Gagal menyimpan User');
        }
    }

    function logout()
    {
        Session::forget('loginStatus');
        Auth::logout();
        return redirect('login');
    }
}
