<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Detail Produk</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <a href="https://wa.me/628815074046"
        class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg z-50"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Hubungi kami via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 448 512">
            <path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
        </svg>
    </a>
    <div class="bg-gray-100">
        <a href="{{ route('welcome')}}">
            <button class="px-5 py-3 items-center ml-5 rounded-lg flex hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                <h2 class="ml-5 text-3xl">Back</h2>
            </button>
        </a>
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full rounded-lg shadow-md mb-4">
                </div>

                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-3xl font-bold mb-2">{{ $product->name }}</h2>
                    <div class="mb-4">
                        <span class="text-2xl font-bold mr-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        @php
                        $rating = round($product->average_rating ?? 0, 1);
                        @endphp
                        <div class="flex items-center mt-2 space-x-1 text-yellow-400 text-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $i <= floor($rating) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 {{ $i <= floor($rating) ? '' : 'text-gray-300' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.462 4.477a1 1 0 00.95.69h4.71c.969 0 1.371 1.24.588 1.81l-3.81 2.748a1 1 0 00-.364 1.118l1.462 4.477c.3.921-.755 1.688-1.54 1.118l-3.81-2.748a1 1 0 00-1.175 0l-3.81 2.748c-.784.57-1.838-.197-1.54-1.118l1.462-4.477a1 1 0 00-.364-1.118L2.049 9.904c-.783-.57-.38-1.81.588-1.81h4.71a1 1 0 00.95-.69l1.462-4.477z" />
                                </svg>
                                @endfor
                                <span class="ml-1 text-gray-600">({{ $rating }})</span>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-1">{{ $product->deskripsi }}</p>
                    <p class="text-gray-700 mb-6">Minimal Pembelian {{ $product->minPax }} pax</p>
                    @auth
                    <form action="{{ route('addCart') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="product" value="{{ $product->id }}">
                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1"
                                class="w-12 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="flex space-x-4 mb-6">
                            <button
                                class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="bg-red-500 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-red-700 w-fit">
                        Login untuk Add to Cart
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>

</html>