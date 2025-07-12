<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/app.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="/node_modules/alpinejs/dist/cdn.js"></script>
</head>

<body x-data="{ sidebarOpen: true }" class="relative">
    <x-sidebar></x-sidebar>

    <div :class="sidebarOpen ? 'pl-60' : 'pl-12'" class="transition-all duration-300 p-4 pt-20 min-h-screen w-full h-screen absolute top-0 bg-gray-100">
        <main>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 grid grid-cols-12 gap-6 xxl:col-span-9">

                    <div class="col-span-12 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                        {{-- Total Penjualan --}}
                        <div class="bg-white shadow-xl rounded-lg transform hover:scale-105 transition duration-300">
                            <div class="p-5 space-y-2">
                                <div class="flex justify-between items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    {{-- Filter bulan --}}
                                    <select id="monthFilter" class="text-sm border-gray-300 rounded px-2 py-1">
                                        <option value="all">Semua</option>
                                        @foreach($months as $month)
                                        <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($month . '-01')->isoFormat('MMMM YYYY') }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold leading-8">Rp{{ number_format($totalSales, 0, ',', '.') }}</div>
                                    <div class="text-base text-gray-600">Total Penjualan</div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Produk --}}
                        <div class="bg-white shadow-xl rounded-lg transform hover:scale-105 transition duration-300">
                            <div class="p-5 space-y-2">
                                <div class="flex justify-between">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold">{{ $product }}</div>
                                    <div class="text-base text-gray-600">Total Produk</div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Transaksi --}}
                        <div class="bg-white shadow-xl rounded-lg transform hover:scale-105 transition duration-300">
                            <div class="p-5 space-y-2">
                                <div class="flex justify-between">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11l-1.5 2H5.5L7 10z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold">{{ $totalTransactions }}</div>
                                    <div class="text-base text-gray-600">Transaksi Selesai</div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Pelanggan --}}
                        <div class="bg-white shadow-xl rounded-lg transform hover:scale-105 transition duration-300">
                            <div class="p-5 space-y-2">
                                <div class="flex justify-between">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 11a4 4 0 10-8 0 4 4 0 008 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold">{{ $totalCustomers }}</div>
                                    <div class="text-base text-gray-600">Pelanggan Unik</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Chart Penjualan --}}
                    <div class="col-span-12 mt-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold">Grafik Penjualan</h2>
                            <select id="timeRange" class="border px-3 py-2 rounded text-sm">
                                <option value="daily">Per Hari</option>
                                <option value="monthly">Per Bulan</option>
                                <option value="yearly">Per Tahun</option>
                            </select>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow" id="chartline"></div>
                    </div>

                    <div class="col-span-12 mt-5">
                        <div class="bg-white p-4 rounded shadow">
                            <h2 class="text-lg font-semibold mb-3">Top 5 Pelanggan (≥ 2 Transaksi)</h2>
                            @if($topCustomers->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                No
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama Pelanggan
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total Transaksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topCustomers as $index => $customer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $customer->user->name ?? 'User ID ' . $customer->user_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $customer->total_transactions }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-sm text-gray-500">Belum ada pelanggan yang membeli lebih dari 1 kali.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Tabel Produk Terlaris --}}
                    <div class="col-span-12">
                        <div class="bg-white p-4 rounded shadow mt-5">
                            <h2 class="text-lg font-semibold mb-3">Produk Terlaris</h2>
                            @if ($topProducts->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topProducts->take(10) as $productName => $qty)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $productName }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $qty }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-sm text-gray-500">Tidak ada data penjualan.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const chartData = {
            daily: {
                labels: @json($dailyLabels),
                series: [{
                    name: 'Penjualan',
                    type: 'area',
                    data: @json($dailyTotals)
                }]
            },
            monthly: {
                labels: @json($monthlyLabels),
                series: [{
                    name: 'Penjualan',
                    type: 'area',
                    data: @json($monthlyTotals)
                }]
            },
            yearly: {
                labels: @json($yearlyLabels),
                series: [{
                    name: 'Penjualan',
                    type: 'area',
                    data: @json($yearlyTotals)
                }]
            }
        };

        const chartOptions = {
            series: chartData.daily.series,
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: [0.35, 1]
            },
            labels: chartData.daily.labels,
            yaxis: [{
                title: {
                    text: 'Penjualan'
                }
            }],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: y => y ? 'Rp' + y.toLocaleString('id-ID') : y
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#chartline"), chartOptions);
        chart.render();

        document.getElementById('timeRange').addEventListener('change', function(e) {
            const value = e.target.value;
            chart.updateOptions({
                series: chartData[value].series,
                labels: chartData[value].labels
            });
        });

        // Auto-submit on month filter change
        document.getElementById('monthFilter').addEventListener('change', function() {
            const selectedMonth = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('month', selectedMonth);
            window.location.href = url.toString();
        });
    </script>
</body>


</html>