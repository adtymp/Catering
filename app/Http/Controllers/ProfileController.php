<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|different:oldPassword',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->oldPassword, $user->password)) {
            return back()->withErrors(['oldPassword' => 'Password lama tidak sesuai.']);
        }

        if (strcmp($request->oldPassword, $request->newPassword) == 0) {
            return back()->withErrors(['newPassword' => 'Password baru harus berbeda dengan password lama.']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect()->route('login')->with('success', 'Akun Terhapus.');
    }
}
