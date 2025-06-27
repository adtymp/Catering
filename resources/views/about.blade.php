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

<body>
    {{-- Navbar --}}
    <x-navbar :categories="$categories" :cartCount="$cartCount" />

    <div class="bg-white pt-6">
        {{-- Hero Section --}}
        <div class="relative w-full max-w-7xl h-[500px] mx-auto">
            <img
                src="https://wallpaperaccess.com/full/9328792.jpg"
                alt="Contoh Gambar"
                class="w-full h-full object-cover rounded-xl relative z-10"
                onload="this.previousElementSibling?.style.display='none'"
            />
        </div>

        {{-- Deskripsi Tentang --}}
        <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:gap-x-8 lg:px-8 p-8 text-justify leading-relaxed">
            <p>
                <strong>Catering Cangkir Cak Ning</strong> merupakan usaha di bidang pemesanan makanan untuk setiap acara seperti ulang tahun, takjil, syukuran, oleh-oleh, dan lain-lain. Catering ini sudah berdiri sejak tahun 20--. Kami menyediakan berbagai jenis makanan seperti Kue Kering, Nasi Kotak, Snack, serta beberapa paket makanan lainnya.
            </p>
        </div>

        {{-- Galeri Produk --}}
        <div class="w-full min-h-screen p-8">
            <div class="w-full max-w-7xl mx-auto mt-10 rounded-2xl bg-white shadow-2xl overflow-hidden p-6 space-y-10">

                {{-- Header Katalog --}}
                <div class="text-center">
                    <h2 class="text-2xl font-bold">Katalog</h2>
                    <p class="text-gray-600 mt-2">Deskripsi produk akan muncul di sini. Konten ini bisa panjang atau pendek dan kotaknya akan menyesuaikan tinggi otomatis.</p>
                </div>

                {{-- Galeri Gambar --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    {{-- Gambar kiri --}}
                    <div class="aspect-[4/5] rounded-lg bg-gray-200 overflow-hidden">
                        <img src="https://1.bp.blogspot.com/-_72emwM-7uE/XrPi-4DtFvI/AAAAAAAAG8Y/rByYTDh5MkcxFNZwMEcYRgT1057GYbggwCLcBGAsYHQ/s1600/aneka-resep-kue-kering-untuk-lebaran-2020-unik-dan-cantik.jpg" alt="Kue Kering" class="w-full h-full object-cover" onerror="this.style.display='none'" />
                    </div>

                    {{-- Gambar tengah --}}
                    <div class="grid grid-cols-1 gap-4">
                        <div class="aspect-[3/2] rounded-lg bg-gray-200 overflow-hidden">
                            <img src="https://data.1freewallpapers.com/download/delicious-food-1440x900.jpg" alt="Makanan Lezat" class="w-full h-full object-cover" onerror="this.style.display='none'" />
                        </div>
                        <div class="aspect-[3/2] rounded-lg bg-gray-200 overflow-hidden">
                            <img src="http://3.bp.blogspot.com/-33ZL0bTeBzU/Vmt3xtEF1XI/AAAAAAAAlts/Mg00d0UF5RI/s1600/traditional-indonesian-food.jpg" alt="Makanan Tradisional" class="w-full h-full object-cover" onerror="this.style.display='none'" />
                        </div>
                    </div>

                    {{-- Gambar kanan --}}
                    <div class="aspect-[4/5] rounded-lg bg-gray-200 overflow-hidden">
                        <img src="https://wallpapercave.com/wp/wp10277289.jpg" alt="Makanan Penutup" class="w-full h-full object-cover" onerror="this.style.display='none'" />
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="block bg-white text-center text-amber-800 mt-10">
        <div class="p-8 space-x-4">
            <a href="#!" class="text-blue-600 hover:underline"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#!" class="text-blue-400 hover:underline"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#!" class="text-pink-600 hover:underline"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#!" class="text-blue-500 hover:underline"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
            <a href="#!" class="text-gray-800 hover:underline"><i class="fab fa-github"></i> GitHub</a>
        </div>

        <div class="text-center py-5 bg-gray-100 text-gray-700">
            &copy; 2024 Catering Cangkir Cak Ning. All rights reserved.
        </div>
    </footer>
</body>


</html>