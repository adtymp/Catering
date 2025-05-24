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
    <title>Tambah Alamat</title>
</head>

<body class="bg-white text-slate-900">
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
        role="alert">
        <strong class="font-bold">Sukses! </strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button
            @click="show = false"
            class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700">
            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
            </svg>
        </button>
    </div>
    @endif
    @if ($errors->any())
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 6000)"
        x-show="show"
        x-transition
        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
        role="alert">
        <strong class="font-bold">Terjadi Kesalahan!</strong>
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button
            @click="show = false"
            class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-700">
            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
            </svg>
        </button>
    </div>
    @endif

    <div class="flex justify-between items-center p-6 border-b">
        <a href="{{ route('profile') }}">
            <button class="flex items-center hover:bg-gray-200 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512">
                    <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                <h2 class="ml-3 text-xl">Back</h2>
            </button>
        </a>
        <h1 class="font-bold text-3xl">Tambah Alamat</h1>
        <h1 class="font-bold text-3xl">LOGO</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 gap-x-8 p-6">
        <div class="col-span-1 md:col-span-2">
            <form action="{{ route('addAddress') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @php
                $user = Auth::user();
                @endphp
                <div class="grid lg:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium block mb-2">Penerima</label>
                        <input type="text" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{ old('name', $user->name ?? '') }}" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-2">Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('name', $user->email ?? '') }}" class="px-4 py-2.5 w-full text-sm outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-2">No. Telepon</label>
                        <input type="text" name="no_hp" placeholder="Masukkan No.Telepon" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-2">Kecamatan</label>
                        <input type="text" name="kecamatan" placeholder="Masukkan Kecamatan" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600" />
                    </div>
                    <div x-data="locationPicker()" x-init="init()" class="space-y-4 relative mb-4">
                        <div class="relative">
                            <label class="text-sm font-medium block mb-2">Alamat</label>
                            <input
                                type="text"
                                x-model="address"
                                name="address"
                                @input.debounce.1000ms="searchAddress()"
                                @keydown.enter.prevent="suggestions.length && selectSuggestion(suggestions[0])"
                                @focus="showSuggestions = true"
                                @click.outside="showSuggestions = false"
                                placeholder="Ketik atau klik peta"
                                class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600">

                            <!-- Dropdown saran alamat -->
                            <ul x-show="showSuggestions && suggestions.length"
                                class="absolute z-[999] bg-white border border-gray-300 mt-1 w-full rounded-md shadow-lg text-sm">
                                <template x-for="item in suggestions" :key="item.place_id">
                                    <li @click="selectSuggestion(item)"
                                        class="px-4 py-2 hover:bg-blue-100 cursor-pointer"
                                        x-text="item.display_name">
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <!-- Map -->
                        <div id="map" class="h-64 w-full rounded border relative z-0"></div>
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-2">Label</label>
                        <select name="label" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600">
                            <option value="Rumah">Rumah</option>
                            <option value="Kos">Kos</option>
                            <option value="Kantor">Kantor</option>
                        </select>
                    </div>
                    <div>
                        <label class="px-4 py-2.5 w-full text-sm"><input class="focus:outline-none focus:ring-0" type="checkbox" name="is_default"> Jadikan alamat utama</label>
                    </div>
                    <input type="hidden" name="latitude" value="">
                    <input type="hidden" name="longitude" value="">
                </div>
                <div class="max-w-xl w-full">
                    <div class="mb-4">
                        <label class="text-sm font-medium block mb-4 mt-4">Catatan</label>
                        <textarea name="note" placeholder="Detail lokasi : pagar putih, rumah warna merah" class="px-4 py-2.5 border border-gray-400 w-full text-sm rounded-md focus:outline-blue-600"></textarea>
                    </div>
                    <button class="w-full bg-red-800 hover:bg-red-900 text-amber-300 p-3 items-center rounded-lg justify-between text-center font-semibold">
                        Tambah Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const LOCATIONIQ_API_KEY = "{{ env('LOCATIONIQ_API_KEY') }}";
    </script>
    <script>
        function locationPicker() {
            return {
                map: null,
                marker: null,
                lat: -7.271307,
                lng: 112.762703,
                address: '',
                suggestions: [],
                showSuggestions: false,

                init() {
                    this.map = L.map('map').setView([this.lat, this.lng], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(this.map);

                    this.marker = L.marker([this.lat, this.lng], {
                        draggable: true
                    }).addTo(this.map);

                    this.marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        this.lat = pos.lat;
                        this.lng = pos.lng;
                        this.reverseGeocode();
                    });

                    this.map.on('click', (e) => {
                        this.lat = e.latlng.lat;
                        this.lng = e.latlng.lng;
                        this.marker.setLatLng([this.lat, this.lng]);
                        this.reverseGeocode();
                    });

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            this.lat = position.coords.latitude;
                            this.lng = position.coords.longitude;
                            this.map.setView([this.lat, this.lng], 15);
                            this.marker.setLatLng([this.lat, this.lng]);
                            this.reverseGeocode();
                        });
                    } else {
                        this.reverseGeocode();
                    }
                    this.$watch('lat', value => {
                        const input = document.querySelector('input[name="latitude"]');
                        if (input) input.value = value;
                    });

                    this.$watch('lng', value => {
                        const input = document.querySelector('input[name="longitude"]');
                        if (input) input.value = value;
                    });

                    this.map.whenReady(() => {
                        setTimeout(() => {
                            this.map.invalidateSize();
                        }, 500);
                    });
                },

                async reverseGeocode() {
                    try {
                        const res = await fetch(`https://us1.locationiq.com/v1/reverse?key=${LOCATIONIQ_API_KEY}&lat=${this.lat}&lon=${this.lng}&format=json`);
                        const data = await res.json();
                        this.address = data.display_name || '';
                    } catch (e) {
                        console.error('Reverse geocode error', e);
                    }
                },

                async searchAddress() {
                    if (!this.address || this.address.length < 3) return;

                    try {
                        const res = await fetch(`https://us1.locationiq.com/v1/search?key=${LOCATIONIQ_API_KEY}&q=${encodeURIComponent(this.address)}&countrycodes=id&format=json`);
                        const data = await res.json();
                        this.suggestions = data || [];
                        this.showSuggestions = true;

                        if (this.suggestions.length === 1) {
                            this.selectSuggestion(this.suggestions[0]);
                        }
                    } catch (e) {
                        console.error('Search failed', e);
                        this.suggestions = [];
                    }
                },

                selectSuggestion(item) {
                    this.lat = parseFloat(item.lat);
                    this.lng = parseFloat(item.lon);
                    this.map.setView([this.lat, this.lng], 15);
                    this.marker.setLatLng([this.lat, this.lng]);
                    this.showSuggestions = false;
                }
            };
        }
    </script>
</body>