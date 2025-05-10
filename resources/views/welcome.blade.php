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
    <x-search></x-search>
    <!--main-->
    <div>
        <!-- Paket -->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Paket</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                @php
                $paketProducts = $products->filter(function($product) {
                return $product->category && $product->category->name === 'Paket';
                })->take(4);
                @endphp

                @foreach ($paketProducts as $product)
                <x-card :product="$product" :categories="$categories" />
                @endforeach

            </div>
        </div>
        <!-- Dibawah 20000 -->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Di Bawah Rp 20.000</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                @php
                $paketProducts = $products->filter(function($product){
                return $product->price <= 20000;
                    })->take(4);
                    @endphp

                    @foreach ($paketProducts as $product)
                    <x-card :product="$product" :categories="$categories" />
                    @endforeach
            </div>
        </div>
        <!-- Nasi Kotak -->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 pt-10 border-b-4">
            <div class="text-2xl justify-between flex">
                <h1 class="font-bold">Nasi Kotak</h1>
                <a href="">Show All</a>
            </div>
            <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
                @php
                $paketProducts = $products->filter(function($product) {
                return $product->category && $product->category->name === 'Nasi Kotak';
                })->take(4);
                @endphp

                @foreach ($paketProducts as $product)
                <x-card :product="$product" :categories="$categories" />
                @endforeach

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