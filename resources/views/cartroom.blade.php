<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CartRoom</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <a href="{{ route('welcome')}}">
        <button class="px-5 py-3 items-center ml-5 rounded-lg flex hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            <h2 class="ml-5 text-3xl">Back</h2>
        </button>
    </a>
    <form id="checkout-form" action="{{ route('payment.checkout') }}" method="POST">
        @csrf
        <div class="p-6 max-w-4xl mx-auto space-y-4 mb-32">
            <h1 class="text-3xl font-bold text-center mb-6">KERANJANGMU</h1>

            @auth
            @forelse ($carts as $cart)
            <div class="bg-white rounded-lg shadow-md p-4 flex gap-4 items-center">
                <input type="checkbox" name="cart_items[]" value="{{ $cart->id }}" class="mt-2 select-cart-item">
                <img src="{{ asset('storage/' . $cart->product->image) }}" alt="Product" class="w-28 h-28 object-cover rounded-md">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">{{ $cart->product->name }}</h2>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ $cart->product->deskripsi }}</p>

                    <div class="flex items-center mt-2 space-x-2">
                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                        <span>{{ $cart->quantity }}</span>
                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                    </div>
                </div>

                <!-- Hapus tombol -->
                <!-- <form> DI SINI HARUS DIHAPUS -->
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 6V4h6v2m-3 0v14M5 6l1 14h12l1-14" />
                    </svg>
                </button>
                <!-- </form> DI SINI HARUS DIHAPUS -->
            </div>
            @empty
            <p class="text-center text-gray-500">Keranjangmu masih kosong.</p>
            @endforelse
            @endauth

            @guest
            <p class="text-center text-gray-500">Login untuk melihat halaman ini.</p>
            @endguest
        </div>

        <!-- FOOTER KERANJANG -->
        <div class="fixed bottom-0 w-full bg-white shadow-lg border-t border-gray-200 z-50">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <div class="p-4">
                    <p class="text-gray-600 text-sm">Total Harga</p>
                    <h2 class="text-xl font-bold text-gray-900" id="totalHarga">Rp 0</h2>
                </div>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </form>

    <script>
        const checkboxes = document.querySelectorAll('.select-cart-item');
        const totalDisplay = document.getElementById('totalHarga');

        const prices = @json($carts -> mapWithKeys(fn($c) => [$c -> id => $c -> product -> price * $c -> quantity]));

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += prices[cb.value];
                }
            });

            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    </script>


</body>

</html>