<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function pembayaran(Request $request)
    {
        try {
            $request->validate([
                'address_id' => 'required|exists:addresses,id',
                'products' => 'required|array',
                'products.*.id' => 'required|exists:products,id',
                'products.*.cart_id' => 'required|exists:carts,id',
                'products.*.image' => 'required|string|max:255',
                'products.*.name' => 'required|string|max:50',
                'products.*.qty' => 'required|integer|min:1',
                'products.*.price' => 'required|numeric|min:0',
                'delivery_date' => 'required|date|after_or_equal:today',
                'delivery_time' => 'required|date_format:H:i',
                'shipping_method' => 'required|string|max:255',
                'note'      => 'nullable|string',
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'diskon' => 'required|numeric|min:0',
                'ongkir' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
            ]);

            $user = Auth::user();

            if (!$request->hasFile('bukti_pembayaran')) {
                return back()->withErrors(['bukti_pembayaran' => 'File image tidak ditemukan.']);
            }

            $originalName = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $bukti = $request->file('bukti_pembayaran')->storeAs('payments', $originalName, 'public');

            do {
                $timestamp = now();
                $randomNumber = rand(100, 999);
                $idPesanan = 'CCN' . $timestamp->format('YmdHis') . $randomNumber;
            } while (Payment::where('idPesanan', $idPesanan)->exists());

            $status = 'Permintaan';

            $sementara = array_sum(array_map(fn($p) => $p['qty'] * $p['price'], $request->products));
            $fixTotal = $sementara + $request->ongkir - $request->diskon;

            if ($fixTotal != $request->total) {
                return back()->withErrors(['total' => 'Total pembayaran tidak valid.']);
            }

            $payment = new Payment();
            $payment->user_id = $user->id;
            $payment->idPesanan = $idPesanan;
            $payment->address_id = $request->address_id;
            $payment->products = json_encode($request->products);
            $payment->delivery_date = $request->delivery_date;
            $payment->delivery_time = $request->delivery_time;
            $payment->shipping_method = $request->shipping_method;
            $payment->bukti_pembayaran = $bukti;
            $payment->note = $request->note;
            $payment->status = $status;
            $payment->diskon = $request->diskon;
            $payment->ongkir = $request->ongkir;
            $payment->total = $request->total;

            if ($payment->save()) {
                $cart = array_column($request->products, 'cart_id');
                Cart::where('user_id', Auth::id())->whereIn('id', $cart)->delete();

                $address = Address::find($request->address_id);
                $penerima = $address->nama_penerima;
                $adminPhone = '08815074046';

                $waAdmin = '62' . ltrim($adminPhone, '0');

                $pesan = "Halo Admin, ada pesanan baru!\n\n" .
                    "ID Pesanan: *{$payment->idPesanan}*\n" .
                    "Penerima: {$penerima}\n" .
                    "Total: Rp. " . number_format($payment->total, 0, ',', '.') . "\n" .
                    "Tanggal Kirim: *" . $payment->delivery_date->format('d M Y') . "*\n" .
                    "Pukul: *" . $payment->delivery_time->format('H:i') . " WIB*\n\n" .
                    "Note: *{$payment->note}*\n\n" .
                    "Mohon segera diproses ya.";

                $pesanEncoded = urlencode($pesan);
                $whatsappUrl = "https://wa.me/{$waAdmin}?text={$pesanEncoded}";

                return redirect()->route('order')
                    ->with('success', 'Pembayaran berhasil dibuat.')
                    ->with('wa_to_admin', $whatsappUrl);
            } else {
                return back()->withErrors('Gagal membuat pesanan, silakan coba lagi.');
            }
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
        }
    }
}
