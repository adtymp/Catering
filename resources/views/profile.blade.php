<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <title>Profile</title>
</head>

<body class="profile-page">
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <div class="h-full bg-gray-200 p-8">
        <div class="bg-white rounded-lg shadow-xl pb-8">
            <div x-data="{ openSettings: false }" class="absolute right-12 mt-4 rounded">
                <button @click="openSettings = !openSettings" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
                <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute right-0 w-40 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                    <div class="py-2 border-b">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Settings</p>
                        <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Share Profile</span>
                        </button>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Block User</span>
                        </button>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">More Info</span>
                        </button>
                    </div>
                    <div class="py-2">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Feedback</p>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Report</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full h-[250px] rounded-tl-lg rounded-tr-lg">
            </div>
            @auth
            <div class="flex flex-col items-center -mt-20">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile.jpg" class="w-40 border-4 border-white rounded-full">
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{ Auth::user()->name }}</p>
                </div>
                @endauth
                <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                    <div class="flex items-center space-x-4 mt-2">
                        <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                            </svg>
                            <span>Connect</span>
                        </button>
                        <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Message</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                <div class="w-full flex flex-col 2xl:w-1/3">
                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                        <h4 class="text-xl text-gray-900 font-bold">Personal Info</h4>
                        @auth
                        <ul class="mt-2 text-gray-700">
                            <li class="flex border-y py-2">
                                <span class="font-bold w-24">Full name:</span>
                                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Birthday:</span>
                                <span class="text-gray-700">24 Jul, 1991</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Joined:</span>
                                <span class="text-gray-700">{{ Auth::user()->created_at->format('d M Y') }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Email:</span>
                                <span class="text-gray-700">{{ substr(Auth::user()->email, 0, 3) . str_repeat('*', 5) . '@' . explode('@', Auth::user()->email)[1] }}</span>
                            </li>
                        </ul>
                        @endauth
                    </div>
                    <div x-data="{ addAddress : false }" class="flex-1 bg-white rounded-lg shadow-xl mt-4 p-8">
                        <div class="justify-between flex items-center">
                            <h4 class="text-2xl text-gray-900 font-bold">Alamat</h4>
                            <a href="{{ route('address') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-center p-2 rounded-lg border-gray-100 border-2 hover:border-black hover:border-2">Tambah Alamat</a>
                        </div>
                        @forelse($addresses as $address)
                        <div class="relative px-4">
                            <!-- start::Timeline item -->
                            <div x-data="{ setting: false }" class="relative w-full my-6 px-4">
                                <div class="flex items-center border-b-2 pb-3">
                                    <!-- Icon Lokasi -->
                                    <div class="w-10 flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 384 512">
                                            <path fill="#858585"
                                                d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                        </svg>
                                    </div>

                                    <!-- Informasi Alamat -->
                                    <div class="flex-1 ml-2">
                                        <p class="text-sm font-bold">{{ $address->address }}</p>
                                        <p class="font-semibold text-xs">{{ $address->nama_penerima }}, <span>{{ $address->no_hp }}</span></p>
                                        <p class="text-xs">{{ $address->label }}</p>
                                        <p class="text-xs text-gray-500">{{ $address->note }}</p>
                                    </div>

                                    <!-- Tombol Setting -->
                                    <div class="relative">
                                        <button @click="setting = !setting" class="flex items-center justify-center w-8 h-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 128 512">
                                                <path fill="#858585"
                                                    d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <div x-show="setting" @click.away="setting = false" x-transition
                                            class="absolute right-0 mt-2 w-28 bg-white border border-gray-200 rounded shadow-md z-20">
                                            <ul class="text-sm text-gray-700">
                                                <li class="px-4 py-2 hover:bg-amber-100 cursor-pointer">Edit</li>
                                                <div x-data="{ deleteAddress : false }">
                                                    <button @click="deleteAddress=true" class="px-4 py-2 hover:bg-amber-100 cursor-pointer w-full">Hapus</button>
                                                    <div x-show="deleteAddress" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                        <div class="bg-white rounded-lg p-6 w-80">
                                                            <h2 class="text-lg font-semibold text-red-600 mb-4 text-center p-2 border-b-2">Konfirmasi Penghapusan</h2>
                                                            <p class="mb-6">Yakin ingin menghapus alamat ini?</p>
                                                            <div class="flex justify-end space-x-4">
                                                                <form method="POST" action="{{ route('address.deleteAddress', $address->id) }}">
                                                                    @csrf
                                                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Ya, Hapus</button>
                                                                </form>
                                                                <button @click="deleteAddress = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 text-gray-800">
                                                                    Batal
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end::Timeline item -->
                        </div>
                        @empty
                        <div class="flex justify-center items-center p-6 border-2 rounded-lg mt-4 border-gray-300">
                            <a href="{{ route('address') }}">
                                <button type="button" class="text-3xl font-semibold rounded-full border-2 p-2 border-gray-300 text-gray-300 w-8 h-8 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path fill="#c5c6d0" d="M248 72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 160L40 232c-13.3 0-24 10.7-24 24s10.7 24 24 24l160 0 0 160c0 13.3 10.7 24 24 24s24-10.7 24-24l0-160 160 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-160 0 0-160z" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>