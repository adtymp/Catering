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
    <form method="POST" action="" enctype="multipart/form-data">

        <div x-data="{openPayment : false }" class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12 p-6">
            <!-- Left: Form -->
            <div class="lg:col-span-2">
                @php
                $addresses = Auth::user()->addresses ?? collect();
                @endphp
                <!-- Alamat -->
                <div x-data="alamatDropdown({{ $addresses->toJson() }})" x-init="init()" class="relative w-full">
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
                                        <div @click="setSelected(address)"
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
                        <div class="w-full border-b-2 border-gray-300 p-4 rounded bg-white text-xs">
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

                <!-- Metode Pengantaran -->
                <div class="mt-12">
                    <h2 class="font-semibold mb-6">Metode Pengantaran</h2>
                    <div class="grid gap-4 lg:grid-cols-2">
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="antar" class="w-5 h-5 shipping-method" />
                            <span class=" text-slate-600">Di antar</span>
                        </label>
                        <label class="bg-gray-100 p-4 rounded-md border flex items-center gap-4 cursor-pointer">
                            <input type="radio" name="shipping_method" value="ambil" class="w-5 h-5 shipping-method" />
                            <span class="text-slate-600">Ambil di Tempat</span>
                        </label>
                    </div>
                </div>
                <!-- Kode Promo -->
                <div class="mt-12 max-w-md">
                    <label class="block mb-2">Punya kode promo?</label>
                    <div class="flex gap-4">
                        <input type="text" placeholder="Promo code" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md text-sm">Terapkan</button>
                    </div>
                </div>
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
                <ul class="space-y-4 text-sm text-slate-600">
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
                        <input type="hidden" name="total" x-ref="totalInput">
                    </div>
                </ul>


                <div class="mt-8 space-y-4">
                    <button @click="openPayment = true" type="button" class="w-full px-4 py-2.5 text-sm bg-gray-100 hover:bg-gray-200 border border-gray-300 text-slate-900 rounded-md">Lakukan Pembayaran</button>
                    <button type="submit" class="w-full px-4 py-2.5 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md">Selesaikan Pembayaran</button>
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
                            <input type="file" name="bukti_pembayaran" accept="image/*" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function alamatDropdown(addressList) {
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
                }
            }
        }
    </script>


    <script>
        const LOCATIONIQ_API_KEY = "{{ env('LOCATIONIQ_API_KEY') }}";
    </script>
    <script>
        function locationPicker() {
            return {
                map: null,
                marker: null,
                lat: '',
                lng: '',
                address: '',
                suggestions: [],
                showSuggestions: false,
                outletLat: -7.271307, //lokasi outlet
                outletLng: 112.762703,
                distance: 0,
                shippingCost: 0,
                subtotal: {{$subtotal}},

                init() {
                    this.map = L.map('map').setView([this.outletLat, this.outletLng], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(this.map);

                    this.marker = L.marker([this.outletLat, this.outletLng], {
                        draggable: true
                    }).addTo(this.map);

                    this.marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        this.lat = pos.lat;
                        this.lng = pos.lng;
                        this.reverseGeocode();
                        this.calculateDistance();
                    });

                    this.map.on('click', (e) => {
                        this.lat = e.latlng.lat;
                        this.lng = e.latlng.lng;
                        this.marker.setLatLng([this.lat, this.lng]);
                        this.reverseGeocode();
                        this.calculateDistance();
                    });

                    // Lokasi awal dari browser
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            this.lat = position.coords.latitude;
                            this.lng = position.coords.longitude;
                            this.map.setView([this.lat, this.lng], 15);
                            this.marker.setLatLng([this.lat, this.lng]);
                            this.reverseGeocode();
                            this.calculateDistance();
                        }, () => {
                            this.lat = this.outletLat;
                            this.lng = this.outletLng;
                            this.reverseGeocode();
                            this.calculateDistance();
                        });
                    }

                    // Event metode pengantaran
                    document.querySelectorAll('input[name="shipping_method"]').forEach(el => {
                        el.addEventListener('change', () => {
                            this.updateShippingCost();
                        });
                    });
                },

                async reverseGeocode() {
                    try {
                        const res = await fetch(`https://us1.locationiq.com/v1/reverse?key={{ env('LOCATIONIQ_API_KEY') }}&lat=${this.lat}&lon=${this.lng}&format=json`);
                        const data = await res.json();
                        this.address = data.display_name || '';
                    } catch (e) {
                        console.error('Reverse geocode error', e);
                    }
                },

                async searchAddress() {
                    if (!this.address || this.address.length < 3) return;

                    try {
                        const res = await fetch(`https://us1.locationiq.com/v1/search?key={{ env('LOCATIONIQ_API_KEY') }}&q=${encodeURIComponent(this.address)}&countrycodes=id&format=json`);
                        const data = await res.json();
                        this.suggestions = data || [];
                        this.showSuggestions = true;

                        if (data.length > 0) {
                            this.selectSuggestion(data[0]);
                        }
                    } catch (e) {
                        console.error('Search failed', e);
                        this.suggestions = [];
                    }
                },

                selectSuggestion(item) {
                    this.lat = parseFloat(item.lat);
                    this.lng = parseFloat(item.lon);
                    this.address = item.display_name;
                    this.map.setView([this.lat, this.lng], 15);
                    this.marker.setLatLng([this.lat, this.lng]);
                    this.showSuggestions = false;
                    this.calculateDistance();
                },

                calculateDistance() {
                    const R = 6371; // km
                    const dLat = (this.lat - this.outletLat) * Math.PI / 180;
                    const dLon = (this.lng - this.outletLng) * Math.PI / 180;
                    const a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(this.outletLat * Math.PI / 180) * Math.cos(this.lat * Math.PI / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    this.distance = R * c;

                    this.updateShippingCost();
                },

                updateShippingCost() {
                    let cost = Math.max(3000, Math.round(this.distance / 2 * 2000));

                    cost = Math.ceil(cost / 1000) * 1000;

                    this.shippingCost = cost;

                    const ongkirEl = document.getElementById('ongkir');
                    const totalEl = document.getElementById('total');

                    const method = document.querySelector('input[name="shipping_method"]:checked')?.value;
                    if (method === 'antar') {
                        ongkirEl.textContent = 'Rp ' + cost.toLocaleString('id-ID');
                        totalEl.textContent = 'Rp ' + (this.subtotal + cost).toLocaleString('id-ID');
                    } else {
                        ongkirEl.textContent = 'Rp 0';
                        totalEl.textContent = 'Rp ' + this.subtotal.toLocaleString('id-ID');
                    }
                }
            }
        }
    </script>

</body>

</html>