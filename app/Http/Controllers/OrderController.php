<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Payment;
use App\Models\ProductRate;
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

        $ratingData = [];

        foreach ($payments as $payment) {
            $products = json_decode($payment->products, true);

            foreach ($products as $product) {
                $hasRated = ProductRate::where('user_id', Auth::id())
                    ->where('product_id', $product['id'])
                    ->exists();

                $dismissed = session('dismissed_rating_' . $product['id']);

                $ratingData[] = [
                    'payment_id' => $payment->id,
                    'product' => $product,
                    'hasRated' => $hasRated,
                    'dismissed' => $dismissed,
                    'status' => $payment->status,
                ];
            }
        }

        return view('order', compact('categories', 'cartCount', 'payments', 'addresses', 'ratingData'));
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
    public function update(Request $request, $id, $status)
    {
        $allowedStatuses = ['Dibatalkan', 'Diterima', 'Proses', 'Siap Diambil', 'Siap Diantar', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return back()->withErrors('Status tidak valid');
        }

        $payment = Payment::findOrFail($id);
        $user = Auth::user();
        $previousStatus = $payment->status;

        if ($status === 'Dibatalkan') {
            $request->validate([
                'cancel_reason' => 'required|string|max:255',
            ]);

            $payment->cancel_reason = $request->cancel_reason;
        }

        if ($status === 'Selesai') {
            if ($user->hasRole('admin')) {
                $payment->admin_done = true;
            } else {
                $payment->user_done = true;
            }

            if ($payment->admin_done && $payment->user_done) {
                $payment->status = 'Selesai';
            }
        } else {
            $payment->status = $status;
        }

        if ($payment->save()) {
            if ($previousStatus != $payment->status) {
                $this->sendStatusUpdateNotification($payment, $user);
            }

            $redirectRoute = $user->hasRole('admin') ? 'orderAdmin' : 'order';

            if ($payment->status === 'Selesai') {
                return redirect()->route($redirectRoute)->with('success', 'Pesanan telah selesai.');
            }

            return redirect()->route($redirectRoute)->with('info', 'Status telah diperbarui.');
        }

        return back()->withErrors('Gagal memperbarui status.');
    }
    protected function sendStatusUpdateNotification($payment, $user)
    {
        $adminPhone = '08815074046';

        if (!$payment->address) {
            throw new \Exception("Alamat pengiriman tidak ditemukan");
        }

        if (empty($payment->address->no_hp)) {
            throw new \Exception("Nomor HP penerima tidak tersedia");
        }

        if (!$payment->user) {
            throw new \Exception("Data pemesan tidak ditemukan");
        }

        $customerPhone = $payment->address->no_hp;
        $outletLink = "https://maps.app.goo.gl/cYkAenFKGob6a4Lj9";

        // Format nomor WhatsApp
        $waAdmin = '62' . ltrim($adminPhone, '0');
        $waCustomer = '62' . ltrim($customerPhone, '0');

        $statusMessages = [
            'Diterima' => [
                'admin' => "Pesanan *{$payment->idPesanan}* telah diterima.\n\n" .
                    "Nama: {$payment->address->nama_penerima}\n" .
                    "Total: Rp " . number_format($payment->total, 0, ',', '.'),
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n telah kami terima dan tunggu untuk diproses.\n\nTerima kasih."
            ],
            'Proses' => [
                'admin' => "Pesanan *{$payment->idPesanan}* sedang diproses.",
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n sedang dalam proses.\n\nKami akan menginformasikan perkembangan selanjutnya."
            ],
            'Siap Diambil' => [
                'admin' => "Pesanan *{$payment->idPesanan}* siap diambil.\n\n" .
                    "Nama: {$payment->address->nama_penerima}\n" .
                    "Total: Rp " . number_format($payment->total, 0, ',', '.'),
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n sudah siap diambil di lokasi kami.\n\n" .
                    "*Lokasi Outlet*:\n{$outletLink}\n\n" .
                    "Jam operasional: 08:00-17:00 WIB."
            ],
            'Siap Diantar' => [
                'admin' => "Pesanan *{$payment->idPesanan}* sedang dalam pengiriman.\n\n" .
                    "Nama: {$payment->address->nama_penerima}\n" .
                    "Alamat: {$payment->address->alamat_lengkap}",
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n dalam perjalanan ke alamat Anda.\n\nMohon ditunggu."
            ],
            'Selesai' => [
                'admin' => "Pesanan *{$payment->idPesanan}* telah selesai.",
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n telah selesai.\n\nTerima kasih telah berbelanja dengan kami!"
            ],
            'Dibatalkan' => [
                'admin' => "Pesanan *{$payment->idPesanan}* dibatalkan.\nAlasan: {$payment->cancel_reason}",
                'customer' => "Halo {$payment->address->nama_penerima},\n\nPesanan Anda dengan ID *{$payment->idPesanan}*\n telah dibatalkan.\nAlasan: {$payment->cancel_reason}\n\nJika ini kesalahan, silakan hubungi kami."
            ]
        ];

        if (isset($statusMessages[$payment->status])) {
            $adminMessage = urlencode($statusMessages[$payment->status]['admin']);
            $customerMessage = urlencode($statusMessages[$payment->status]['customer']);

            $adminWaUrl = "https://wa.me/{$waAdmin}?text={$adminMessage}";
            $customerWaUrl = "https://wa.me/{$waCustomer}?text={$customerMessage}";

            if ($user->hasRole('admin')) {
                session()->flash('wa_to_customer', $customerWaUrl);
            } else {
                session()->flash('wa_to_admin', $adminWaUrl);
            }
        }
    }
}
