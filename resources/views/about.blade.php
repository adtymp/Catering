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
    <x-navbar :categories="$categories" :cartCount="$cartCount" />

    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    theme: {
      extend: {
        gridTemplateRows: {
          '[auto,auto,1fr]': 'auto auto 1fr',
        },
      },
    },
  }
  ```
-->
<div class="bg-white">
  <div class="pt-6">
   <div class="relative w-full max-w-7xl h-[500px] mx-auto">
  <!-- Skeleton Placeholder -->
  <div class="absolute inset-0 bg-gray-200 rounded-xl animate-pulse"></div>

  <!-- Gambar -->
    <img
        src="https://via.placeholder.com/1024x320"
        alt="Contoh Gambar"
        class="w-full h-full object-cover rounded-xl relative z-10"
        onload="this.previousElementSibling.style.display='none'"
     />
    </div>

    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:gap-x-8 lg:px-8">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum suscipit in dolor enim itaque ab magnam corporis optio maiores doloribus. Facilis voluptas aperiam quisquam alias voluptates consequuntur numquam minima laudantium!Lorem Lorem lorem ipsu
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum suscipit in dolor enim itaque ab magnam corporis optio maiores doloribus. Facilis voluptas aperiam quisquam alias voluptates consequuntur numquam minima laudantium!Lorem Lorem lorem ipsu

    </div>

    <div class="w-full h-screen p-8">
 <!-- Container besar -->
<div class="w-full max-w-7xl mx-auto mt-10 rounded-2xl bg-white shadow-2xl overflow-hidden p-6 space-y-10">

  <!-- Judul / Deskripsi dinamis -->
  <div>
    <h2 class="text-2xl font-bold">Judul Produk</h2>
    <p class="text-gray-600 mt-2">Deskripsi produk akan muncul di sini. Konten ini bisa panjang atau pendek dan kotaknya akan menyesuaikan tinggi otomatis.</p>
  </div>

  <!-- Galeri gambar -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Gambar kiri -->
    <div class="aspect-[4/5] rounded-lg bg-gray-200 overflow-hidden">
      <img src="" alt="Gambar 1" class="w-full h-full object-cover" onerror="this.style.display='none'">
    </div>

    <!-- Gambar tengah (2 susun) -->
    <div class="grid grid-cols-1 gap-4">
      <div class="aspect-[3/2] rounded-lg bg-gray-200 overflow-hidden">
        <img src="" alt="Gambar 2" class="w-full h-full object-cover" onerror="this.style.display='none'">
      </div>
      <div class="aspect-[3/2] rounded-lg bg-gray-200 overflow-hidden">
        <img src="" alt="Gambar 3" class="w-full h-full object-cover" onerror="this.style.display='none'">
      </div>
    </div>

    <!-- Gambar kanan -->
    <div class="aspect-[4/5] rounded-lg bg-gray-200 overflow-hidden">
      <img src="" alt="Gambar 4" class="w-full h-full object-cover" onerror="this.style.display='none'">
    </div>


  </div>



</div>


    </div>
  </div>
  <div class="mx-auto w-full max-w-screen-2xl px-4 py-8">
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Kotak 1 -->
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-md">
      <h3 class="mb-2 text-xl font-bold">Judul Kotak 1</h3>
      <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    <!-- Kotak 2 -->
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-md">
      <h3 class="mb-2 text-xl font-bold">Judul Kotak 2</h3>
      <p class="text-gray-600">Sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>

    <!-- Kotak 3 -->
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-md">
      <h3 class="mb-2 text-xl font-bold">Judul Kotak 3</h3>
      <p class="text-gray-600">Ut enim ad minim veniam, quis nostrud exercitation.</p>
    </div>
  </div>
</div>

<div>
    <footer class="bg-yellow-100 text-center text-amber-800">
        <div class="p-8">
            <section class="">
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i>Facebook</a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter">Twitter</i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i>Instagram</a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i>Linkedlin</a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i>github</a>
            </section>
        </div>
        <div class="text-center p-5" style="background-color: rgba(0, 0, 0, 0.2);">
            @2024 Recommended
        </div>
    </footer>
</div>

</body>
</html>
