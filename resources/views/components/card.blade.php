@props(['categories', 'product'])

<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-2xl hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300">
    <div class="relative">
        <a href="{{ route('detailProduct', $product->id) }}">
            <img class="w-full h-40 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
    </div>
    <h3 class="text-sm font-semibold text-gray-900 mt-2">{{ $product->name }}</h3>
    <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $product->deskripsi }}</p>
    <div class="flex items-center justify-between mt-3">
        <span class="text-primary font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        <button class="bg-red-700 text-white py-2 px-4 rounded-full hover:bg-red-900 transition">
            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
            </svg>
        </button>
    </div>
</div>