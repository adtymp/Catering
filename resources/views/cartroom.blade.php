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
    <title>Dashboard</title>
</head>

<body>
    <x-navbar></x-navbar>
    <div class="p-6">
        <h1 class="text-4xl font-bold text-center">KERANJANGMU</h1>
        <div class="bg-white rounded-lg shadow-md p-12 hover:shadow-lg transition-shadow flex duration-300">
            <div class="">
                <a href="#">
                    <img
                        class="w-40 h-40 object-cover"
                        src=""
                        alt="">
                </a>
            </div>
            <div class="p-4 relative">
                <h3 class="text-xl font-bold text-gray-900 mt-2">Nama Makanan</h3>
                <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                </p>
                <div>
                    <button class="p-2 bg-gray-100 h-1 w-2">
                        -
                    </button>
                    14
                    <button class="p-2 bg-gray-100">
                        +
                    </button>
                </div>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-primary font-bold text-base">Rp. Harga</span>
                    <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>