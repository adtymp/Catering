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
    <title>Pembayaran</title>
</head>

<body class="bg-white text-slate-900">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b">
        <a href="{{ route('cart') }}">
            <button class="flex items-center hover:bg-gray-200 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512">
                    <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                <h2 class="ml-3 text-xl">Back</h2>
            </button>
        </a>
        <h1 class="font-bold text-3xl">LOGO</h1>
    </div>

    <!-- Main Section -->
    <div x-data="{openPayment : false }" class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12 p-6">
        <!-- Left: Form -->
        <div class="lg:col-span-2">
            <form>
                <!-- Informasi Pembayaran -->
                <div>
                    <h1 class="text-3xl font-bold mb-6">Pembayaran</h1>
                    @php
                    $user = Auth::user();
                    @endphp
                    <div class="grid lg:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium block mb-2">Penerima</label>
                            <input type="text" name="name" placeholder="Masukkan Nama Penerima" value="{{ old('name', $user->name ?? '') }}" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        <div>
                            <label class="text-sm font-medium block mb-2">Email</label>
                            <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('name', $user->email ?? '') }}" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        @foreach (['No.Telp' => 'text', 'Address Line' => 'text', 'City' => 'text'] as $label => $type)
                        <div>
                            <label class="text-sm font-medium block mb-2">{{ $label }}</label>
                            <input type="{{ $type }}" placeholder="Masukkan {{ $label }}" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        @endforeach
                        <div>
                            <label class="text-sm font-medium block mb-2">Note</label>
                            <textarea name="note" placeholder="Note" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Metode Pengantaran -->
                <div class="mt-12">
                    <h2 class="text-xl font-semibold mb-6">Metode Pengantaran</h2>
                    <div class="grid gap-4 lg:grid-cols-2">
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="antar" class="w-5 h-5 shipping-method" />
                            <span class="text-sm font-medium text-slate-600">Di antar</span>
                        </label>
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="ambil" class="w-5 h-5 shipping-method" />
                            <span class="text-sm font-medium text-slate-600">Ambil di Tempat</span>
                        </label>
                    </div>
                </div>


                <!-- Metode Pembayaran -->
                <div class="mt-12">
                    <h2 class="text-xl font-semibold mb-6">Metode Pembayaran</h2>
                    <div class="grid gap-4 lg:grid-cols-2">
                        <label class="bg-gray-100 p-4 rounded-md border cursor-pointer">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" class="w-5 h-5" checked />
                                <div class="flex gap-2">
                                    <img src="https://readymadeui.com/images/visa.webp" class="w-12" alt="Visa" />
                                    <img src="https://readymadeui.com/images/american-express.webp" class="w-12" alt="Amex" />
                                    <img src="https://readymadeui.com/images/master.webp" class="w-12" alt="Mastercard" />
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-slate-500">Bayar dengan kartu debit/kredit</p>
                        </label>

                        <label class="bg-gray-100 p-4 rounded-md border cursor-pointer">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" class="w-5 h-5" />
                                <img src="https://readymadeui.com/images/paypal.webp" class="w-20" alt="Paypal" />
                            </div>
                            <p class="mt-4 text-sm text-slate-500">Bayar dengan akun PayPal</p>
                        </label>
                    </div>
                </div>

                <!-- Promo -->
                <div class="mt-12 max-w-md">
                    <label class="text-sm font-medium block mb-2">Punya kode promo?</label>
                    <div class="flex gap-4">
                        <input type="text" placeholder="Promo code" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md text-sm">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right: Ringkasan Pesanan -->
        <div class="lg:col-span-1">
            @foreach ($selectedCarts as $item)
            <div class="flex justify-between text-sm font-semibold mb-6">
                <span>{{ $item->product->name }} <span>x {{ $item->quantity }}</span></span>
                <span>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
            </div>
            @endforeach
            <h2 class="text-xl font-semibold mb-6">Ringkasan Pesanan</h2>
            <ul class="space-y-4 text-sm font-medium text-slate-600">
                <li class="flex justify-between">Subtotal
                    <span class="font-semibold text-slate-900" id="subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </li>
                <li class="flex justify-between">Diskon
                    <span class="font-semibold text-slate-900">Rp 0</span>
                </li>
                <li class="flex justify-between">Ongkos Kirim
                    <span class="font-semibold text-slate-900" id="ongkir">Rp 0</span>
                </li>
                <li class="flex justify-between">Pajak
                    <span class="font-semibold text-slate-900">Rp 0</span>
                </li>
                <hr class="border-slate-300" />
                <div class="flex justify-between font-bold text-black">
                    <span>Total</span>
                    <span id="total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </ul>


            <div class="mt-8 space-y-4">
                <button @click="openPayment = true" type="button" class="w-full px-4 py-2.5 text-sm font-medium bg-gray-100 hover:bg-gray-200 border border-gray-300 text-slate-900 rounded-md">Lakukan Pembayaran</button>
                <button type="button" class="w-full px-4 py-2.5 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-md">Selesaikan Pembayaran</button>
            </div>
            <div x-show="openPayment" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6  overflow-y-auto rounded-lg">
                    <div class="flex justify-end">
                        <button @click="openPayment = false" class="text-gray-500 hover:text-red-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <h2 class="text-center mb-4">Kirim ke Rekening : </h2>
                    <h1 class="font-bold text-xl text-center mb-4">46575453465</h1>
                    <label>Upload</label>
                    <div class="border-2 p-4">
                        <input type="file" name="bukti">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.shipping-method').forEach(radio => {
            radio.addEventListener('change', updateTotal);
        });

        function updateTotal() {
            const selectedMethod = document.querySelector('.shipping-method:checked').value;
            const subtotal = {{$subtotal}};
            const ongkir = selectedMethod === 'antar' ? 10000 : 0;

            document.getElementById('ongkir').innerText = `Rp ${formatRupiah(ongkir)}`;
            document.getElementById('total').innerText = `Rp ${formatRupiah(subtotal + ongkir)}`;
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>


</body>

</html>