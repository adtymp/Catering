<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $payments = Payment::where('user_id', Auth::id())->get();
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('order', compact('categories', 'cartCount', 'payments', 'addresses'));
    }

    public function indexAdmin()
    {
        $payments = Payment::all();
        return view('adminorder', compact('payments'));
    }

    public function detailPesanan($idPesanan)
    {
        $categories = Category::all();
        $payments = Payment::where('idPesanan', $idPesanan)->firstOrFail();
        return view('detailpesanan', compact('categories', 'payments'));
    }

    public function adminDetailPesanan($idPesanan)
    {
        $categories = Category::all();
        $payments = Payment::where('idPesanan', $idPesanan)->firstOrFail();
        return view('admindetailpesanan', compact('categories', 'payments'));
    }
    public function update($id, $status)
    {
        $allowedStatuses = ['Dibatalkan', 'Diterima', 'Proses', 'Siap Diambil', 'Siap Diantar', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return back()->withErrors('Status tidak valid');
        }

        $payment = Payment::findOrFail($id);
        $payment->status = $status;

        if ($payment->save()) {
            return redirect()->route('orderAdmin')->with('success', 'Pesanan diubah statusnya menjadi "' . $payment->status . '"');
        } else {
            return back()->withErrors('Gagal Mengubah Status');
        }
    }
}
