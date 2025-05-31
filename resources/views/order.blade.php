<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Pesananmu</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <div class="flex justify-between items-center p-3 border-b">
        <a href="{{ route('welcome') }}">
            <button class="flex items-center hover:bg-gray-200 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512">
                    <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                <h2 class="ml-3 text-xl">Back</h2>
            </button>
        </a>
        <h1 class="text-3xl font-bold">Pesananmu</h1>
    </div>
    <div x-data="{ selectedStatus: 'Permintaan' }">
        <div class="border-b-2 border-red-500 bg-white">
            <div class="p-3 flex flex-wrap gap-2 justify-between">
                @foreach (['Permintaan', 'Diterima', 'Proses', 'Siap Diantar', 'Siap Diambil', 'Selesai', 'Dibatalkan'] as $status)
                <button
                    @click="selectedStatus = '{{ $status }}'"
                    :class="selectedStatus === '{{ $status }}' ? 'text-red-500 font-bold' : 'hover:text-red-500 font-semibold'"
                    class="px-2 py-1 transition">
                    {{ $status }}
                </button>
                @endforeach
            </div>
        </div>

        <div>
            @forelse ($payments as $payment)
            <div x-show="selectedStatus === '{{ $payment->status }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2" class="p-3 border-b-2 border-gray-300">
                <a href="{{ route('detailpesanan', $payment->idPesanan) }}">
                    <div>
                        @php $products = json_decode($payment->products, true); @endphp
                        <ul class="list-disc pl-4">
                            @foreach ($products as $product)
                            <li class="font-semibold items-center flex justify-between p-3 shadow-sm">
                                <div class="flex justify-between items-center">
                                    <img src="{{ asset('storage/' . ($product['image'] ?? 'images/default.jpg')) }}" alt="{{ $product['name'] }}" class="w-12 h-12 mr-2 object-cover rounded">
                                    <div class="flex">
                                        <p>{{ $product['name'] ?? 'Produk Tanpa Nama' }}</p>
                                        <p class="ml-3 text-gray-500">x {{ $product['qty'] }}</p>
                                    </div>
                                </div>
                                <p>Rp{{ number_format($product['price'] * $product['qty'], 0, ',', '.') }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="font-bold text-xl">
                        <p class="justify-end flex">Total: Rp{{ number_format($payment->total, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @empty
            <p class="text-center text-gray-500 py-6">Tidak ada pesanan ditemukan.</p>
            @endforelse
        </div>
    </div>

</body>

</html>