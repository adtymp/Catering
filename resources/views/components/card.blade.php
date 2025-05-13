@props(['categories', 'product'])
<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-2xl hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300">
    <div class="relative">
        <a href="{{ route('detailproduct', $product->slug) }}">
            <img class="w-full h-40 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <h3 class="font-bold text-gray-900 mt-2">{{ $product->name }}</h3>
            <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $product->deskripsi }}</p>
        </a>
    </div>
    <div class="flex items-center justify-between mt-3">
        <p class="text-primary font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-red-800 text-sm">min Pax : 10</p>
    </div>
</div>