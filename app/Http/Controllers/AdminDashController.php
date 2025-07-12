<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $payments = Payment::all();
        $selectedMonth = request('month', 'all');
        $query = Payment::where('status', 'Selesai');
        $totalTransactions = Payment::where('status', 'Selesai')->count();
        $totalCustomers = Payment::where('status', 'Selesai')->distinct('user_id')->count('user_id');
        $topCustomers = Payment::where('status', 'Selesai')
            ->select('user_id', DB::raw('COUNT(*) as total_transactions'))
            ->groupBy('user_id')
            ->having('total_transactions', '>=', 2)
            ->orderByDesc('total_transactions')
            ->with('user')
            ->limit(5)
            ->get();

        if ($selectedMonth !== 'all') {
            try {
                $carbonMonth = Carbon::parse($selectedMonth . '-01');
                $query->whereYear('created_at', $carbonMonth->year)
                    ->whereMonth('created_at', $carbonMonth->month);
            } catch (\Exception $e) {
            }
        }

        $totalSales = $query->sum('total');

        $months = Payment::where('status', 'Selesai')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan")
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->pluck('bulan');

        $allPayments = Payment::where('status', 'Selesai')->get();
        $productQuantities = collect();

        foreach ($allPayments as $payment) {
            $products = json_decode($payment->products, true);

            if (is_array($products)) {
                $productIds = [];

                foreach ($products as $item) {
                    if (isset($item['id'])) {
                        $productIds[] = $item['id'];
                    } elseif (is_array($item) && isset($item[0]['id'])) {
                        foreach ($item as $prod) {
                            if (isset($prod['id'])) {
                                $productIds[] = $prod['id'];
                            }
                        }
                    }
                }

                foreach (array_unique($productIds) as $productId) {
                    $productQuantities[$productId] = ($productQuantities[$productId] ?? 0) + 1;
                }
            }
        }


        $productNames = Product::whereIn('id', $productQuantities->keys())->pluck('name', 'id');

        $topProducts = $productQuantities->mapWithKeys(function ($qty, $id) use ($productNames) {
            return [$productNames[$id] ?? 'Produk ID ' . $id => $qty];
        })->sortDesc();

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
            'payments',
            'months',
            'selectedMonth',
            'totalTransactions',
            'totalCustomers',
            'topCustomers'
        ));
    }
}
