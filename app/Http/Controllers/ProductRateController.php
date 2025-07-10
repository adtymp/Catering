<?php

namespace App\Http\Controllers;

use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRateController extends Controller
{
    public function addRate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_id' => 'required|exists:payments,id',
            'rate' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $user = Auth::id();

        // Cegah rating ganda
        $exists = ProductRate::where('user_id', $user)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Kamu sudah memberi penilaian untuk produk ini.');
        }

        ProductRate::create([
            'user_id'    => $user,
            'product_id' => $request->product_id,
            'payment_id' => $request->payment_id,
            'rate'       => $request->rate,
            'review'     => $request->review,
        ]);

        return back()->with('success', 'Terima kasih atas penilaianmu!');
    }

    public function dismiss(Request $request)
    {
        session()->put('dismissed_rating_' . $request->product_id, true);
        return back();
    }
}
