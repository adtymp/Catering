<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\CekLogin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
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

            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admindashboard'));
            } elseif ($user->hasRole('customer')) {
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Maaf, Ulangi inputan'])->withInput();
            }
        }
    }

    public function regis(Request $request)
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
            $user->assignRole('customer');

            Auth::login($user);
            Session::put('loginStatus', true);
            
            return redirect()->route('welcome')->with('success', 'Anda berhasil mendaftarkan akun');
        } else {
            return back()->withErrors('Gagal menyimpan User');
        }
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password = encrypt('123456dummy');

                if ($newUser->save()) {
                    $newUser->assignRole('customer');
                    Auth::login($newUser);
                    return redirect()->intended('/');
                } else {
                    return back()->withErrors('Gagal menyimpan User');
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function logout()
    {
        Session::forget('loginStatus');
        Auth::logout();
        return redirect('login');
    }
}
