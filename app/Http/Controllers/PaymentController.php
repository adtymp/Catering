<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $defaultAddress = $user->addresses()->where('is_default', true)->first();
        $addresses = $user->addresses()->get();

        return view('payment', compact('defaultAddress', 'addresses'));
    }
    public function checkOut(Request $request)
    {
        $selectedCartIds = $request->input('cart_items', []);

        if (empty($selectedCartIds)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 item untuk checkout.');
        }

        // Ambil data cart
        $selectedCarts = Cart::with('product')->whereIn('id', $selectedCartIds)->get();

        // Hitung total
        $subtotal = $selectedCarts->sum(fn($item) => $item->product->price * $item->quantity);

        // Ambil alamat user
        $user = Auth::user();
        $defaultAddress = $user->addresses()->where('is_default', true)->first();
        $addresses = $user->addresses;

        // Kirim ke view
        return view('payment', compact('selectedCarts', 'subtotal', 'defaultAddress', 'addresses'));
    }

    public function bayar()
    {
        return view('profile');
    }
}
