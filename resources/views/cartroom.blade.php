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
    <title>CartRoom</title>
</head>

<body class="min-h-screen">

    <x-navbar :categories="$categories" />

    <div class="p-6 max-w-4xl mx-auto space-y-4 mb-32">
        <h1 class="text-3xl font-bold text-center mb-6">KERANJANGMU</h1>

        <!-- forelse (cartItems as item) -->
        <div class="bg-white rounded-lg shadow-md p-4 flex gap-4">
            <img src="" alt="Product" class="w-28 h-28 object-cover rounded-md">
            <!-- asset('storage/' . itemproductimage) -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold">item->product->name</h2>
                <p class="text-sm text-gray-500 line-clamp-2">item->product->description</p>

                <div class="flex items-center mt-2 space-x-2">
                    <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                    <span>item->quantity</span>
                    <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                </div>

                <div class="mt-2 font-semibold text-amber-600">
                    <!-- Rp  number_format($item->product->price * $item->quantity, 0, ',', '.') -->
                </div>
            </div>

            <form action="" method="POST">
                <!--  route('cart.remove', itemid)  -->
                <!-- csrf -->
                <!-- method('DELETE') -->
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 6V4h6v2m-3 0v14M5 6l1 14h12l1-14" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 flex gap-4">
            <img src="" alt="Product" class="w-28 h-28 object-cover rounded-md">
            <!-- asset('storage/' . itemproductimage) -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold">item->product->name</h2>
                <p class="text-sm text-gray-500 line-clamp-2">item->product->description</p>

                <div class="flex items-center mt-2 space-x-2">
                    <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                    <span>item->quantity</span>
                    <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                </div>

                <div class="mt-2 font-semibold text-amber-600">
                    <!-- Rp  number_format($item->product->price * $item->quantity, 0, ',', '.') -->
                </div>
            </div>

            <form action="" method="POST">
                <!--  route('cart.remove', itemid)  -->
                <!-- csrf -->
                <!-- method('DELETE') -->
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 6V4h6v2m-3 0v14M5 6l1 14h12l1-14" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 flex gap-4">
            <img src="" alt="Product" class="w-28 h-28 object-cover rounded-md">
            <!-- asset('storage/' . itemproductimage) -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold">item->product->name</h2>
                <p class="text-sm text-gray-500 line-clamp-2">item->product->description</p>

                <div class="flex items-center mt-2 space-x-2">
                    <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                    <span>item->quantity</span>
                    <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                </div>

                <div class="mt-2 font-semibold text-amber-600">
                    <!-- Rp  number_format($item->product->price * $item->quantity, 0, ',', '.') -->
                </div>
            </div>

            <form action="" method="POST">
            <!--  route('cart.remove', itemid)  -->
                <!-- csrf -->
                <!-- method('DELETE') -->
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 6V4h6v2m-3 0v14M5 6l1 14h12l1-14"/>
                    </svg>
                </button>
            </form>
        </div>
        <!-- empty -->
        <p class="text-center text-gray-500">Keranjangmu masih kosong.</p>
        <!-- endforelse -->
    </div>

    <!-- Footer Keranjang (Total Harga dan Tombol Bayar) -->
    <div class="fixed bottom-0 w-full bg-white shadow-lg border-t border-gray-200 z-50">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <div class="p-4">
                <p class="text-gray-600 text-sm">Total Harga</p>
                <h2 class="text-xl font-bold text-gray-900">Rp number_format(total, 0, ',', '.') </h2>
            </div>
            <form action="" method="POST">
                <!--  route('checkout')  -->
                <!-- csrf -->
                <button class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>

</body>

</html>