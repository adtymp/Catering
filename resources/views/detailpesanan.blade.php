<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Detail Pesanan</title>
</head>

<body class="bg-gray-100">
    <div class="flex justify-between items-center p-6 border-b bg-white">
        <a href="{{ route('order') }}">
            <button class="flex items-center hover:bg-gray-200 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512">
                    <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                <h2 class="ml-3 text-xl">Back</h2>
            </button>
        </a>
    </div>
    <div class="grid md:grid-cols-2 gap-y-12 gap-x-8 p-3">
        <div class="md:col-span-1">
            <div class="w-full border border-gray-200 p-4 rounded-t-xl bg-white text-xs shadow-md">
                @if ($payments->status == 'permintaan')
                <p class="text-sm text-center text-red-600 p-4">Pesanan anda sedang dalam status permintaan pesanan ke admin</p>
                @endif
                <div class="border-b">
                    <div class="p-2 space-y-4 text-sm">
                        <p class="font-semibold">Metode Pengantaran : {{ $payments->shipping_method}}</p>
                        <p class="font-semibold">ID Pesanan : {{ $payments->idPesanan}}</p>
                        <p class="font-semibold">Jadwal Pengantaran :</p>
                        <div class="flex p-2">
                            <div class="flex mr-4 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#858585" d="M96 32l0 32L48 64C21.5 64 0 85.5 0 112l0 48 448 0 0-48c0-26.5-21.5-48-48-48l-48 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L160 64l0-32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192L0 192 0 464c0 26.5 21.5 48 48 48l352 0c26.5 0 48-21.5 48-48l0-272z" />
                                </svg>
                                <p class="ml-2">{{ $payments->delivery_date->format('d M Y') }}</p>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#858585" d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                                <p class="ml-2">{{ $payments->delivery_time->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        <p class="font-bold text-center">Note : {{ $payments->note}}</p>
                    </div>
                </div>
                <div class="flex py-4 items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 384 512">
                        <path fill="#858585"
                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg>
                    <div>
                        <div class="flex">
                            <p class="font-semibold ml-2">{{ $payments->address->nama_penerima}}</p>
                            <p class="font-semibold ml-2 text-gray-500">- {{ $payments->address->no_hp}}</p>
                        </div>
                        <p class="font-semibold ml-2">{{ $payments->address->address}}</p>
                        <p class="font-semibold ml-2  text-gray-500">{{ $payments->address->note}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:col-span-1">
            @php
            $products = json_decode($payments->products, true);
            @endphp
            <div class="w-full border-gray-200 p-4 bg-white text-xs shadow-md">
                <ul class="list-disc p-3 border-b">
                    @foreach ($products as $product)
                    <li class="font-semibold flex justify-between shadow-2xs mb-3">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/' . ($product['image'] ?? 'images/default.jpg')) }}" alt="{{ $product['name'] }}" class="w-12 h-12 mr-2 object-cover rounded">
                            <div>
                                <p>{{ $product['name'] ?? 'Produk Tanpa Nama' }}</p>
                                <p> x {{ $product['qty'] }} Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p>Rp{{ number_format($product['price'] * $product['qty'], 0, ',', '.') }}</p>
                    </li>
                    @endforeach
                </ul>
                @php
                $subtotal = 0;
                foreach ($products as $product) {
                $subtotal += $product['price'] * $product['qty'];
                }
                @endphp
                <ul class="space-y-4 text-sm text-slate-600 mt-3">
                    <li class="flex justify-between">Subtotal
                        <span class="font-semibold text-slate-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                    <li class="flex justify-between">Diskon
                        <span class="font-semibold text-slate-900">Rp {{ number_format($payments->diskon, 0, ',', '.') }}</span>
                    </li>
                    <li class="flex justify-between">Ongkos Kirim
                        <span class="font-semibold text-slate-900">Rp {{ number_format($payments->ongkir, 0, ',', '.') }}</span>
                    </li>
                    <hr class="border-slate-300" />
                    <li class="flex justify-between font-bold text-black">
                        <span>Total</span>
                        <span>Rp {{ number_format($payments->total, 0, ',', '.') }}</span>
                    </li>
                    <li>
                        <div x-data="{ bukti: false }" class="text-center p-4">
                            <button @click="bukti = true" type="button" class="text-sm text-blue-600">
                                Lihat Bukti Pembayaran
                            </button>
                            <div x-show="bukti" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                <div class="bg-white p-6 overflow-y-auto rounded-lg relative max-w-lg w-full">
                                    <div class="flex justify-end">
                                        <button @click="bukti = false" type="button" class="text-gray-500 hover:text-red-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                    <img src="{{ asset('storage/' . $payments->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full max-h-[500px] object-contain rounded mt-4">
                                </div>
                            </div>
                        </div>
                    </li>
                    <hr class="border-slate-300" />
                </ul>
                <div class="mt-3">
                    @if ($payments->status == 'Permintaan')
                    <!-- Tombol untuk membuka modal -->
                    <div x-data="{ showModal: false }">
                        <div class="flex justify-end mb-3">
                            <button @click="showModal = true"
                                class="w-40 h-12 bg-red-600 hover:bg-white border-2 hover:border-red-500 font-semibold text-lg text-white hover:text-red-500 rounded-lg transition duration-300">
                                Batalkan
                            </button>
                        </div>

                        <!-- Modal -->
                        <div x-show="showModal"
                            class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center"
                            x-transition>
                            <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6">
                                <h2 class="text-lg font-semibold mb-4 text-center">Alasan Pembatalan</h2>

                                <form method="POST"
                                    action="{{ route('detailpesanan.update', ['id' => $payments->id, 'status' => 'Dibatalkan']) }}">
                                    @csrf

                                    <label class="block mb-2 text-sm font-medium">Pilih Alasan:</label>
                                    <select name="cancel_reason" required class="w-full border rounded px-3 py-2 mb-4">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="Ingin merubah produk">Ingin merubah produk</option>
                                        <option value="Tidak jadi memesan">Tidak jadi memesan</option>
                                        <option value="Menemukan harga lebih murah">Menemukan harga lebih murah</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>

                                    <div class="flex justify-between">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Kirim</button>
                                        <button type="button" @click="showModal = false" class="text-gray-500 hover:text-red-600">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif ($payments->status == 'Siap Diantar' || $payments->status == 'Siap Diambil')
                        @if (!$payments->user_done)
                        <div class="flex justify-end p-3">
                            <form action="{{ route('detailpesanan.update', ['id' => $payments->id, 'status' => 'Selesai']) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-40 h-12 bg-green-600 hover:bg-white border-2 hover:border-green-500 font-semibold text-lg text-white hover:text-green-500 rounded-lg transition duration-300">
                                    Diterima (User)
                                </button>
                            </form>
                        </div>
                        @else
                        <p class="text-sm text-yellow-500 text-right pr-4">Menunggu konfirmasi admin...</p>
                        @endif
                    @elseif ($payments->status == 'Dibatalkan')
                    {{-- Pesanan sudah dibatalkan --}}
                    <div class="flex items-center justify-end p-3">
                        <p class="text-lg text-red-600 font-semibold mr-3">( {{ $payments->cancel_reason }} )</p>
                        <div class="w-48 h-12 flex justify-center items-center bg-red-600 border-2 font-semibold text-lg text-white rounded-lg transition duration-300">
                            Pesanan Dibatalkan
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</body>

</html>