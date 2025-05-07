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
    <x-navbar :categories="$categories" />
    <!--SlideShow-->
    <div class="pb-10 max-w-6xl mx-auto relative overflow-hidden"
        x-data="{
        activeSlide: 1,
        slides: {{ Js::from($banners->map(fn($b, $i) => [
            'id' => $i + 1,
            'tittle' => $b->tittle,
            'image' => asset('storage/' . $b->image)
        ])->values()) }},
        loop() {
            setInterval(() => {
                this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
            }, 3000);
        }
    }"
        x-init="loop">

        <!-- Slide container with slide transition effect -->
        <div class="relative w-full h-72 sm:h-96 overflow-hidden">
            <template x-for="(slide, index) in slides" :key="slide.id">
                <div
                    x-show="activeSlide === slide.id"
                    x-transition:enter="transition-transform duration-1000 ease-out"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition-transform duration-500 ease-in"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="absolute inset-0">
                    <img :src="slide.image" alt=""
                        class="w-full h-full object-cover rounded-md">
                </div>
            </template>

            <!-- Indicator dots inside image, bottom center -->
            <div class="absolute bottom-4 left-0 right-0 flex justify-center items-center space-x-2 z-10">
                <template x-for="slide in slides" :key="slide.id">
                    <button class="w-3 h-3 rounded-full"
                        :class="activeSlide === slide.id ? 'bg-white' : 'bg-gray-400'"
                        @click="activeSlide = slide.id">
                    </button>
                </template>
            </div>
        </div>

        <!-- Navigation arrows -->
        <div class="absolute inset-0 flex items-center justify-between px-4">
            <button @click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1"
                class="text-gray-700 hover:bg-white/70 hover:text-white transition rounded-full w-10 h-10 flex items-center justify-center shadow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <button @click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1"
                class="text-gray-700 hover:bg-white/70 hover:text-white transition rounded-full w-10 h-10 flex items-center justify-center shadow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>

    <!--search-->
    <div class="text-center">
        <div class="p-4">
            <form role="search" method="GET" action=""> <!-- ganti route sesuai kebutuhan -->
                <input name="query" class="bg-gray-100 outline-none border-1 rounded-s p-2" type="search" placeholder="Search">
                <div x-data="{ open: false, selected: '' }" class="relative inline-block text-left">
                    <div>
                        <button @click="open = !open" type="button"
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <span x-text="selected ? selected : 'Filter Harga'"></span>
                            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <ul class="py-1" role="none">
                            <template x-for="(item, index) in ['Tampilkan Semua', 'Dibawah 15000', '15000 - 25000', '25000 - 50000']" :key="index">
                                <li>
                                    <button type="button" @click="selected = item; open = false"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <span x-text="item"></span>
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <!-- Input Hidden untuk Filter yang dikirim -->
                <input type="hidden" name="filter" :value="selected">
                <button class="p-1.5 px-4 bg-red-700 border-red-700 text-white rounded-e hover:bg-red-800" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <!--main-->
    <div class="">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Paket</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                <!--foreach ($products as $product)-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!--endforeach-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
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
        <!--2-->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Snack</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                <!--foreach ($products as $product)-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!--endforeach-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
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
        <!--3-->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Hemat dibawah 15.000</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                <!--foreach ($products as $product)-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!--endforeach-->
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-primary font-bold text-base">Rp. Harga</span>
                        <button class="bg-red-700 text-white py-1 px-3 rounded-full hover:bg-red-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="#">
                            <img
                                class="w-full h-40 object-cover"
                                src=""
                                alt="">
                        </a>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mt-2">Nama Makanan</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rerum vitae dolore, optio, ea deserunt esse ullam quis quia quae, repudiandae assumenda. Neque optio sint laborum molestiae assumenda, eius soluta.
                    </p>
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
    </div>
    <!--footer-->
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>