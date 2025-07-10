@props(['categories', 'product'])
<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-2xl hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300">
    <div class="relative">
        <a href="{{ route('detailproduct', $product->slug) }}">
            <img class="w-full h-40 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <h3 class="font-bold text-gray-900 mt-2">{{ $product->name }}</h3>
            <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $product->deskripsi }}</p>
        </a>
    </div>
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
    <div class="flex items-center justify-between mt-3">
        <p class="text-primary font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-red-800 text-sm">min Pax : {{ $product->minPax }}</p>
    </div>
</div>