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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
        <h1 class="text-3xl font-bold mb-6">Pembayaran</h1>
    </div>

    <!-- Main Section -->
    @php
    $addresses = Auth::user()->addresses ?? collect();
    @endphp
    <form method="POST" action="{{ route('payment.request') }}" enctype="multipart/form-data"
        x-data="checkoutForm({{ $addresses->toJson() }}, {{ $subtotal }}, { lat: -7.271307, lng: 112.762703 })" x-init="init()">
        @csrf
        <div x-data="{openPayment : false }" class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12 p-6">
            <!-- Left: Form -->
            <div class="lg:col-span-2">
                <!-- Alamat -->
                <div x-data="alamatDropdown({{ $addresses->toJson() }}, $data)" x-init="init()" class="relative w-full">
                    <div class="flex justify-between mb-2">
                        <label class="font-semibold">Alamat</label>
                        <div class="relative w-full">
                            <button type="button" @click="change = !change"
                                class="absolute right-2 top-2 z-10 flex items-center justify-center h-1 w-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                    <path fill="#808080" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="change" @click.away="change = false" x-transition
                                class="absolute mt-1 w-full bg-white border border-gray-200 rounded shadow-md z-20 max-h-60 overflow-y-auto">
                                <template x-if="addresses.length > 0">
                                    <template x-for="(address, index) in addresses" :key="index">
                                        <div @click="setSelected(address); change = false"
                                            class="px-4 py-2 hover:bg-amber-100 cursor-pointer border-b border-gray-300 flex items-center">
                                            <div class="mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 384 512">
                                                    <path fill="#858585"
                                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-semibold" x-text="`${address.nama_penerima} - ${address.no_hp}`"></p>
                                                <p class="text-xs" x-text="`${address.label} - ${address.address}`"></p>
                                                <p class="text-xs text-gray-400" x-text="address.note"></p>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                                <template x-if="addresses.length === 0">
                                    <div class="px-4 py-2 text-center text-gray-400">
                                        <a class="p-4" href="{{ route('address') }}">
                                            <button type="button" class="rounded-full border-2 border-gray-300 w-8 h-8 p-2 font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="#c5c6d0" d="M248 72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 160L40 232c-13.3 0-24 10.7-24 24s10.7 24 24 24l160 0 0 160c0 13.3 10.7 24 24 24s24-10.7 24-24l0-160 160 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-160 0 0-160z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Tampilkan alamat terpilih sebagai HTML styled -->
                    <template x-if="selected">
                        <div class="w-full border border-gray-200 p-4 rounded bg-white text-xs shadow-md">
                            <div class="flex  mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 384 512">
                                    <path fill="#858585"
                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                </svg>
                                <p class="font-semibold ml-2" x-text="`${selected.nama_penerima} - ${selected.no_hp}`"></p>
                            </div>
                            <p x-text="`${selected.label} - ${selected.address}`"></p>
                            <p class="text-gray-400" x-text="selected.note"></p>
                        </div>
                    </template>
                    <input type="hidden" name="address_id" :value="selected ? selected.id : ''">
                </div>

                <div class="mt-12">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Kirim / Ambil</h2>

                    <div class="bg-white p-6 rounded shadow-md border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="delivery_date" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal</label>
                                <input type="date" id="delivery_date" name="delivery_date"
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-400 focus:ring-indigo-200 focus:ring-2 px-4 py-2 text-gray-800 shadow-sm transition">
                            </div>

                            <div>
                                <label for="delivery_time" class="block text-sm font-medium text-gray-700 mb-1">Pilih Waktu</label>
                                <input type="time" id="delivery_time" name="delivery_time"
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-400 focus:ring-indigo-200 focus:ring-2 px-4 py-2 text-gray-800 shadow-sm transition">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Metode Pengantaran -->
                <div class="mt-12">
                    <h2 class="font-semibold mb-6">Metode Pengantaran</h2>
                    <div class="grid gap-4 lg:grid-cols-2">
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="antar" class="shipping-method" @change="setShippingMethod('antar')" />
                            <span class=" text-slate-600">Di antar</span>
                        </label>
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="ambil" class="shipping-method" @change="setShippingMethod('ambil')" />
                            <span class="text-slate-600">Ambil di Tempat</span>
                        </label>
                    </div>
                </div>
                <!-- Kode Promo -->
                <!-- <div class="mt-12 max-w-md">
                    <label class="block mb-2">Punya kode promo?</label>
                    <div class="flex gap-4">
                        <input type="text" name="diskon" placeholder="Promo code" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md text-sm">Terapkan</button>
                    </div>
                </div> -->
                <div class="mb-4">
                    <label class="text-sm font-medium block mb-4 mt-4">Catatan</label>
                    <textarea name="note" placeholder="Bungkus plastik saja" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600"></textarea>
                </div>
            </div>

            <!-- Right: Ringkasan Pesanan -->
            <div class="lg:col-span-1">
                @foreach ($selectedCarts as $item)
                <div class="flex items-center justify-between py-2 border-b border-gray-200 text-sm text-gray-700">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product" class="w-16 h-16 object-cover rounded mr-2">
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-xs ml-2">x {{ $item->quantity }}</p>
                    </div>
                    <div class="text-right font-semibold">
                        <p>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                    <input type="hidden" name="products[{{ $loop->index }}][image]" value="{{ $item->product->image }}">
                    <input type="hidden" name="products[{{ $loop->index }}][cart_id]" value="{{ $item->id }}">
                    <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $item->product_id }}">
                    <input type="hidden" name="products[{{ $loop->index }}][name]" value="{{ $item->product->name }}">
                    <input type="hidden" name="products[{{ $loop->index }}][qty]" value="{{ $item->quantity }}">
                    <input type="hidden" name="products[{{ $loop->index }}][price]" value="{{ $item->product->price}}">
                </div>
                @endforeach

                <h2 class="text-xl font-semibold mb-6">Ringkasan Pesanan</h2>
                <ul class="space-y-4 text-sm text-slate-600">
                    <li class="flex justify-between">Subtotal
                        <span class="font-semibold text-slate-900" id="subtotal" x-text="formatRupiah(subtotal)">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                    <!-- <li class="flex justify-between">Diskon
                        <span class="font-semibold text-slate-900" id="diskon" x-text="formatRupiah(diskon)">Rp. 0</span>
                    </li> -->
                    <li class="flex justify-between">Ongkos Kirim
                        <span class="font-semibold text-slate-900" id="ongkir" x-text="formatRupiah(ongkir)"></span>
                    </li>
                    <hr class="border-slate-300" />
                    <li class="flex justify-between font-bold text-black">
                        <span>Total</span>
                        <span id="total" x-text="formatRupiah(total)">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                </ul>
                <input type="hidden" name="ongkir" :value="ongkir" x-init="$el.value = ongkir">
                <input type="hidden" name="diskon" :value="diskon" x-init="$el.value = diskon">
                <input type="hidden" name="total" x-bind:value="total" x-init="$el.value = total">


                <div class="mt-8 space-y-4">
                    <button @click="openPayment = true" type="button" class="w-full px-4 py-2.5 text-sm bg-gray-100 hover:bg-gray-200 border border-gray-300 text-slate-900 rounded-md">Lakukan Pembayaran</button>
                    <button type="submit" class="w-full px-4 py-2.5 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md">Selesaikan Pembayaran</button>
                </div>
                <div x-show="openPayment" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-6  overflow-y-auto rounded-lg">
                        <div class="flex justify-end">
                            <button @click="openPayment = false" type="button" class="text-gray-500 hover:text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <h2 class="text-center mb-4">Kirim ke Rekening : </h2>
                        <h1 class="font-bold text-xl text-center mb-4">BCA 46575453465 (a.n admin)</h1>
                        <label>Upload</label>
                        <div class="border-2 p-4">
                            <input type="file" name="bukti_pembayaran" accept="image/*" required>
                        </div>
                        <button @click="openPayment = false" type="button" class="w-full justify-center items-center rounded-3xl mt-3 px-8 py-2 text-center bg-red-800 text-white hover:bg-red-900">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function alamatDropdown(addressList, parentComponent) {
            return {
                change: false,
                addresses: addressList,
                selected: null,
                init() {
                    if (this.addresses.length > 0) {
                        this.setSelected(this.addresses[0]);
                    }
                },
                setSelected(address) {
                    this.selected = address;
                    this.change = false;
                    parentComponent.setSelected(address);
                }
            }
        }

        function checkoutForm(addresses, subtotal, outletLocation) {
            return {
                addresses,
                subtotal,
                outletLocation,
                selectedAddress: null,
                shippingMethod: '',
                ongkir: 0,
                diskon: 0,

                init() {
                    this.calculateOngkir();
                },

                get total() {
                    const total = this.subtotal + this.ongkir - this.diskon;
                    console.log("=== DEBUG TOTAL CHECKOUT ===");
                    console.log("Subtotal:", this.subtotal);
                    console.log("Ongkir:", this.ongkir);
                    console.log("Diskon:", this.diskon);
                    console.log("Total Akhir:", total);
                    return total;
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number).replace(",00", "");
                },

                setSelected(address) {
                    this.selectedAddress = address;
                    if (this.shippingMethod === 'antar') {
                        this.calculateOngkir();
                    }
                },

                setShippingMethod(method) {
                    this.shippingMethod = method;
                    if (method === 'antar' && this.selectedAddress) {
                        this.calculateOngkir();
                    } else {
                        this.ongkir = 0;
                    }
                },

                haversine(lat1, lon1, lat2, lon2) {
                    const R = 6371;
                    const toRad = deg => deg * Math.PI / 180;
                    const dLat = toRad(lat2 - lat1);
                    const dLon = toRad(lon2 - lon1);
                    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    return R * c;
                },

                calculateOngkir() {
                    if (
                        this.selectedAddress &&
                        this.shippingMethod === 'antar' &&
                        this.selectedAddress.latitude &&
                        this.selectedAddress.longitude
                    ) {
                        const distance = this.haversine(
                            this.outletLocation.lat,
                            this.outletLocation.lng,
                            this.selectedAddress.latitude,
                            this.selectedAddress.longitude
                        );
                        const ongkos = 2000;
                        const bagi = Math.ceil(distance / 2);
                        this.ongkir = ongkos * bagi;
                    } else {
                        this.ongkir = 0;
                    }
                }
            }
        }
    </script>
</body>

</html>