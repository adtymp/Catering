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
    <div
        class="transition-all duration-300 p-4 pt-20 min-h-screen w-full"
        :class="sidebarOpen ? 'pl-60' : 'pl-12'" class="h-screen absolute top-0 ml-48 p-2 w-full bg-gray-100">
        <main>
            <div class="grid grid-cols-12 gap-6">
                <div class="grid grid-cols-12 col-span-12 gap-6 xxl:col-span-9">
                    <div class="col-span-12">
                        <div class="grid grid-cols-9 gap-6">
                            <!-- Terjual -->
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">4.510</div>

                                            <div class="mt-1 text-base text-gray-600">Total Penjualan</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">4.510</div>

                                            <div class="mt-1 text-base text-gray-600">Item Sales</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            @if ($product > 0)
                                            <div class="mt-3 text-3xl font-bold leading-8">{{ $product }}</div>
                                            @endif
                                            <div class="mt-1 text-base text-gray-600">Total Produk</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-10 mt-5">
                        <div class="mb-4">
                            <select id="timeRange" class="border px-3 py-2 rounded">
                                <option value="daily">Per Hari</option>
                                <option value="monthly">Per Bulan</option>
                                <option value="yearly">Per Tahun</option>
                            </select>
                        </div>
                        <div class="">
                            <div class="p-4" id="chartline"></div>
                        </div>
                    </div>
                    <div class="col-span-12 mt-5">
                        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
                            <div class="bg-white p-4 shadow-lg rounded-lg">
                                <h1 class="font-bold text-base">Table</h1>
                                <div class="mt-4">
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto">
                                            <div class="py-2 align-middle inline-block min-w-full">
                                                <div
                                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    <div class="flex cursor-pointer">
                                                                        <span class="mr-2">PRODUCT NAME</span>
                                                                    </div>
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    <div class="flex cursor-pointer">
                                                                        <span class="mr-2">Stock</span>
                                                                    </div>
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    <div class="flex cursor-pointer">
                                                                        <span class="mr-2">STATUS</span>
                                                                    </div>
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    <div class="flex cursor-pointer">
                                                                        <span class="mr-2">ACTION</span>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <tr>
                                                                <td
                                                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                    <p>Apple MacBook Pro 13</p>
                                                                    <p class="text-xs text-gray-400">PC & Laptop
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                    <p>77</p>
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                    <div class="flex text-green-500">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5 mr-1" fill="none"
                                                                            viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        <p>Active</p>
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                    <div class="flex space-x-4">
                                                                        <a href="#" class="text-blue-500 hover:text-blue-600">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="w-5 h-5 mr-1"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                            </svg>
                                                                            <p>Edit</p>
                                                                        </a>
                                                                        <a href="#" class="text-red-500 hover:text-red-600">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="w-5 h-5 mr-1 ml-3"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                            <p>Delete</p>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function data() {

            return {

                isSideMenuOpen: false,
                toggleSideMenu() {
                    this.isSideMenuOpen = !this.isSideMenuOpen
                },
                closeSideMenu() {
                    this.isSideMenuOpen = false
                },
                isNotificationsMenuOpen: false,
                toggleNotificationsMenu() {
                    this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
                },
                closeNotificationsMenu() {
                    this.isNotificationsMenuOpen = false
                },
                isProfileMenuOpen: false,
                toggleProfileMenu() {
                    this.isProfileMenuOpen = !this.isProfileMenuOpen
                },
                closeProfileMenu() {
                    this.isProfileMenuOpen = false
                },
                isPagesMenuOpen: false,
                togglePagesMenu() {
                    this.isPagesMenuOpen = !this.isPagesMenuOpen
                },

            }
        }
    </script>
    <script>
        var chart = document.querySelector('#chartline');

        // Data berdasarkan waktu
        const chartData = {
            daily: {
                labels: ['1 Jun', '2 Jun', '3 Jun', '4 Jun', '5 Jun'],
                series: [{
                        name: 'Penjualan',
                        type: 'area',
                        data: [10, 25, 15, 30, 20]
                    }
                ]
            },
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                series: [{
                        name: 'Penjualan',
                        type: 'area',
                        data: [300, 450, 400, 600, 550, 700]
                    }
                ]
            },
            yearly: {
                labels: ['2019', '2020', '2021', '2022', '2023'],
                series: [{
                        name: 'Penjualan',
                        type: 'area',
                        data: [3500, 4000, 4200, 4700, 5000]
                    }
                ]
            }
        };

        // Opsi awal (harian)
        var options = {
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
            markers: {
                size: 0
            },
            yaxis: [{
                    title: {
                        text: 'Penjualan'
                    }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        return y ? y + ' unit' : y;
                    }
                }
            }
        };

        var apexChart = new ApexCharts(chart, options);
        apexChart.render();

        // Ganti data ketika dropdown dipilih
        document.getElementById('timeRange').addEventListener('change', function(e) {
            const value = e.target.value;
            apexChart.updateOptions({
                series: chartData[value].series,
                labels: chartData[value].labels
            });
        });
    </script>
    </div>
</body>

</html>