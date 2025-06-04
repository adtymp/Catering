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
    <title>Search</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <x-search></x-search>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6">
            @if(isset($name))
            Produk Kategori: {{ $name }}
            @elseif(isset($price))
            Produk dengan Harga ≤ Rp. {{ number_format($price, 0, ',', '.') }}
            @endif
        </h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
            <x-card :product="$product" :categories="$categories" />
            @empty
            <p>Tidak ada produk ditemukan.</p>
            @endforelse
        </div>
    </div>
</body>

</html>