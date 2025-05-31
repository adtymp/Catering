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

<body x-data="{ sidebarOpen: true }" class="flex bg-gray-100">
    <x-sidebar></x-sidebar>
    <div class="transition-all duration-300 p-4 pt-20 min-h-screen w-full"
        :class="sidebarOpen ? 'pl-52' : 'pl-12'" class="h-screen absolute top-0 ml-48 p-2 w-full bg-gray-100">
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
                    x-transition:enter-start="opacity-0 translate-x-2"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-2" class="p-3 border-b-2 border-gray-300 bg-white rounded-lg mb-3">
                    <a href="{{ route('adminDetailPesanan', $payment->idPesanan) }}">
                        <div class="p-4">
                            <div class="border-b pb-4">
                                <p class="font-semibold text-gray-600">ID Pesanan : {{ $payment->idPesanan}}</p>
                            </div>
                            <p>Pengguna : {{ $payment->user->name }}</p>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 384 512">
                                    <path fill="#858585"
                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                </svg>
                                <p class="ml-3">{{ $payment->address->address }}</p>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#858585" d="M48 0C21.5 0 0 21.5 0 48L0 368c0 26.5 21.5 48 48 48l16 0c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L48 0zM416 160l50.7 0L544 237.3l0 18.7-128 0 0-96zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                </svg>
                                <p class="ml-3">Metode Pengantaran : {{ $payment->shipping_method}}</p>
                            </div>
                            <div class="flex">
                                <div class="flex mr-5 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#858585" d="M96 32l0 32L48 64C21.5 64 0 85.5 0 112l0 48 448 0 0-48c0-26.5-21.5-48-48-48l-48 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L160 64l0-32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192L0 192 0 464c0 26.5 21.5 48 48 48l352 0c26.5 0 48-21.5 48-48l0-272z" />
                                    </svg>
                                    <p class="ml-3">{{ $payment->delivery_date->format('d M Y') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#858585" d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                    </svg>
                                    <p class="ml-3">{{ $payment->delivery_time->format('H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                        <div class="font-bold justify-between flex items-center p-2">
                            <p class="">Total</p>
                            <p class="">Rp{{ number_format($payment->total, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
                @empty
                <h1 class="text-gray-400 text-2xl text-center justify-center">Belum ada Transaksi Pesanan</h1>
                @endforelse
            </div>
        </div>
    </div>

</body>

</html>