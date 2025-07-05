<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Payment;
use App\Models\ServiceRate;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $paymentCount = Auth::check()
            ? Payment::where('user_id', Auth::id())
            ->where('status', 'Selesai')
            ->whereDoesntHave('serviceRate')
            ->get() : collect();
        $query = ServiceRate::with(['user', 'payment'])
            ->latest();

        if (request('filter') && request('filter') !== 'all') {
            $query->where('rate', request('filter'));
        }

        $rates = $query->paginate(10);

        $totalRatings = ServiceRate::count();
        $ratingCounts = [
            'all' => $totalRatings,
            5 => ServiceRate::where('rate', 5)->count(),
            4 => ServiceRate::where('rate', 4)->count(),
            3 => ServiceRate::where('rate', 3)->count(),
            2 => ServiceRate::where('rate', 2)->count(),
            1 => ServiceRate::where('rate', 1)->count()
        ];

        return view('ulasan', compact('categories', 'cartCount', 'paymentCount', 'rates', 'ratingCounts'));
    }

    public function addUlasan(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'rate' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $payment = Payment::where('id', $request->payment_id)
            ->where('user_id', Auth::id())
            ->where('status', 'Selesai')
            ->firstOrFail();

        if ($payment->serviceRate) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pembayaran ini');
        }

        ServiceRate::create([
            'user_id' => Auth::id(),
            'payment_id' => $payment->id,
            'rate' => $request->rate,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
