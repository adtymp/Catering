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
                <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute right-0 w-52 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                    <div class="py-2 border-b">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Pengaturan</p>
                        <div x-data="{ changePassword : false }">
                            <button @click="changePassword = true" class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                </svg>
                                <span class="text-sm text-gray-700">Ganti Password</span>
                            </button>
                            <x-user.edit></x-user.edit>
                        </div>
                        <div x-data="{ deleteAccount : false }">
                            <button @click="deleteAccount=true" class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="#fe0606" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                </svg>
                                <span class="text-sm text-gray-700">Hapus Akun</span>
                            </button>
                            <x-user.delete></x-user.delete>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-[100px] rounded-tl-lg rounded-tr-lg">
            </div>
            @auth
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-28 h-28" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                </svg>
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{ Auth::user()->name }}</p>
                </div>
            </div>
            @endauth
            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                <div class="w-full flex flex-col 2xl:w-1/3">
                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                        <h4 class="text-xl text-gray-900 font-bold">Personal Info</h4>
                        @auth
                        <ul class="mt-2 text-gray-700">
                            <li class="flex border-y py-2">
                                <span class="font-bold w-24">Nama:</span>
                                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Terdaftar:</span>
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