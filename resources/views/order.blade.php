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
    @foreach ($ratingData as $item)
    @php
    $product = $item['product'];
    @endphp

    @if (!$item['hasRated'] && !$item['dismissed'] && $item['status'] === 'Selesai')
    <div x-data="{ open: true }" x-show="open" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">

            <!-- Gambar Produk -->
            <div class="flex flex-col items-center justify-center mb-2">
                <img src="{{ asset('storage/' . $product['image']) }}"
                    alt="{{ $product['name'] }}"
                    class="w-24 h-24 rounded object-cover border mb-2">

                <h2 class="text-lg font-semibold text-center">{{ $product['name'] }}</h2>
            </div>


            <form method="POST" action="{{ route('rateProduct.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <input type="hidden" name="payment_id" value="{{ $item['payment_id'] }}">

                <!-- ⭐ Rating Bintang -->
                <div class="justify-center flex mb-2"
                    x-data="{
                            rating: 0,
                            tempRating: 0,
                            icons: [1,2,3,4,5],
                            rate(i) { this.rating = i; },
                            mouseOver(i) { this.tempRating = i; },
                            mouseOut() { this.tempRating = 0; },
                            getColor(i) {
                                if (this.tempRating >= i || this.rating >= i) return 'text-yellow-400';
                                return 'text-gray-300';
                            }
                        }"
                    class="flex items-center space-x-2">
                    <template x-for="i in icons" :key="i">
                        <button type="button"
                            @click="rate(i)"
                            @mouseover="mouseOver(i)"
                            @mouseout="mouseOut()"
                            class="focus:outline-none transition transform hover:scale-125">
                            <span class="text-3xl" :class="getColor(i)">★</span>
                        </button>
                    </template>
                    <input type="hidden" name="rate" x-model="rating" required>
                    <span x-show="rating > 0" class="ml-2 text-gray-600" x-text="rating + ' bintang'"></span>
                </div>

                <!-- Ulasan -->
                <label class="block text-sm mb-1">Ulasan (opsional)</label>
                <textarea name="review" rows="3" class="w-full border px-3 py-2 rounded mb-4" placeholder="Tulis ulasan Anda..."></textarea>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Kirim</button>
            </form>

            <form method="POST" action="{{ route('rateProduct.dismiss') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <button type="submit" class="text-gray-500 hover:text-red-600">Lewati</button>
            </form>
        </div>
    </div>
    </div>
    @endif
    @endforeach
    
    @if(session('wa_to_admin'))
    <div id="waModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Pembayaran Berhasil!</h3>
                <div class="mt-4">
                    <p class="text-sm text-gray-500">
                        Anda akan diarahkan ke WhatsApp admin dalam <span id="countdown">3</span> detik...
                    </p>
                </div>
                <div class="mt-6">
                    <button onclick="closeModal()" type="button" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Tutup
                    </button>
                    <a href="{{ session('wa_to_admin') }}" class="ml-3 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Buka WhatsApp Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let countdown = 3;
        const countdownEl = document.getElementById('countdown');
        const waModal = document.getElementById('waModal');

        const timer = setInterval(() => {
            countdown--;
            countdownEl.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = "{{ session('wa_to_admin') }}";
            }
        }, 1000);

        function closeModal() {
            clearInterval(timer);
            waModal.style.display = 'none';
        }
    </script>
    @endif
</body>

</html>