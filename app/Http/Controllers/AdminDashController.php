<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $payments = Payment::all();
        $totalSales = Payment::where('status', 'Selesai')->sum('total');
        $allPayments = Payment::where('status', 'Selesai')->get();
        $productQuantities = collect();

        foreach ($allPayments as $payment) {
            $products = json_decode($payment->products, true);

            // Pastikan $products adalah array dan bukan null
            if (is_array($products)) {
                foreach ($products as $item) {
                    // Jika $item adalah 1 produk langsung
                    if (isset($item['id']) && isset($item['qty'])) {
                        $productId = $item['id'];
                        $qty = (int) $item['qty'];
                    }
                    // Jika $item adalah array yang berisi beberapa produk (nested)
                    elseif (is_array($item) && isset($item[0]['id'])) {
                        foreach ($item as $prod) {
                            $productId = $prod['id'];
                            $qty = (int) $prod['qty'];

                            $productQuantities[$productId] = ($productQuantities[$productId] ?? 0) + $qty;
                        }
                        continue; // lanjut ke payment berikutnya
                    } else {
                        continue; // skip jika formatnya tidak sesuai
                    }

                    // Tambahkan ke koleksi
                    $productQuantities[$productId] = ($productQuantities[$productId] ?? 0) + $qty;
                }
            }
        }

        $productNames = Product::whereIn('id', $productQuantities->keys())->pluck('name', 'id');

        // Data penjualan per waktu
        $dailySales = Payment::where('status', 'Selesai')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailySales->pluck('date')->toArray();
        $dailyTotals = $dailySales->pluck('total')->toArray();

        $monthlySales = Payment::where('status', 'Selesai')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyLabels = $monthlySales->pluck('month')->map(function ($m) {
            return Carbon::create()->month($m)->translatedFormat('F');
        })->toArray();

        $monthlyTotals = $monthlySales->pluck('total')->toArray();

        $yearlySales = Payment::where('status', 'Selesai')
            ->selectRaw('YEAR(created_at) as year, SUM(total) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();
        $yearlyLabels = $yearlySales->pluck('year')->toArray();
        $yearlyTotals = $yearlySales->pluck('total')->toArray();

        $topProducts = $productQuantities->mapWithKeys(function ($qty, $id) use ($productNames) {
            return [$productNames[$id] ?? 'Produk ID ' . $id => $qty];
        })->sortDesc();

        return view('admindashboard', compact(
            'product',
            'topProducts',
            'totalSales',
            'dailySales',
            'dailyLabels',
            'dailyTotals',
            'monthlySales',
            'monthlyLabels',
            'monthlyTotals',
            'yearlySales',
            'yearlyLabels',
            'yearlyTotals',
            'payments'
        ));
    }
}
