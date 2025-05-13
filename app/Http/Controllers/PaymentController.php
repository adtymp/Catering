<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }
    public function checkOut(Request $request)
    {
        $selectedCartIds = $request->input('cart_items', []);

        if (empty($selectedCartIds)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 item untuk checkout.');
        }

        // Ambil data cart yang dipilih dari database
        $selectedCarts = Cart::with('product')->whereIn('id', $selectedCartIds)->get();

        // Hitung total
        $subtotal = $selectedCarts->sum(fn($item) => $item->product->price * $item->quantity);

        // Kirim ke view payment.blade.php
        return view('payment', compact('selectedCarts', 'subtotal'));
    }
}
