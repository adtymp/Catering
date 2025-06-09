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

    <div class="w-full h-screen p-8 bg-gray-100">
  <!-- Satu Kotak Besar -->
  <div class="h-full w-full rounded-2xl  bg-white shadow-2xl overflow-hidden">

    <!-- Header -->
    <div class="p-6 ">
      <h1 class="text-4xl font-bold">Judul Konten</h1>
      <p class="text-xl mt-2">Deskripsi singkat konten Anda</p>
    </div>

    <!-- Konten Utama -->
    <div class="p-8 overflow-y-auto h-[calc(100%-7.5rem)]">
      <h2 class="text-2xl font-semibold mb-4">Section 1</h2>
      <p class="text-lg mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>

      <h2 class="text-2xl font-semibold mb-4">Section 2</h2>
      <p class="text-lg mb-6">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

      <div class="grid grid-cols-2 gap-4 mt-8">
        <div class="bg-blue-100 p-4 rounded-lg">
          <h3 class="font-bold text-blue-800">Fitur 1</h3>
          <p>Penjelasan fitur pertama</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
          <h3 class="font-bold text-green-800">Fitur 2</h3>
          <p>Penjelasan fitur kedua</p>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 p-4 text-center border-t border-gray-300">
      <p class="text-gray-600">© 2023 Perusahaan Anda</p>
    </div>
  </div>
</div>



    <!-- Image gallery -->
    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
      <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-secondary-product-shot.jpg" alt="Two each of gray, white, and black shirts laying flat." class="hidden size-full rounded-lg object-cover lg:block">
      <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
        <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg" alt="Model wearing plain black basic tee." class="aspect-3/2 w-full rounded-lg object-cover">
        <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg" alt="Model wearing plain gray basic tee." class="aspect-3/2 w-full rounded-lg object-cover">
      </div>
      <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-featured-product-shot.jpg" alt="Model wearing plain white basic tee." class="aspect-4/5 size-full object-cover sm:rounded-lg lg:aspect-auto">
    </div>

    <!-- Product info -->
    <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
      <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Basic Tee 6-Pack</h1>
      </div>

      <!-- Options -->
      <div class="mt-4 lg:row-span-3 lg:mt-0">
        <h2 class="sr-only">Product information</h2>
        <p class="text-3xl tracking-tight text-gray-900">$192</p>

        <!-- Reviews -->
        <div class="mt-6">
          <h3 class="sr-only">Reviews</h3>
          <div class="flex items-center">
            <div class="flex items-center">
              <!-- Active: "text-gray-900", Default: "text-gray-200" -->
              <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
              </svg>
              <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
              </svg>
              <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
              </svg>
              <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
              </svg>
              <svg class="size-5 shrink-0 text-gray-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
              </svg>
            </div>
            <p class="sr-only">4 out of 5 stars</p>
            <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117 reviews</a>
          </div>
        </div>

        <form class="mt-10">
          <!-- Colors -->
          <div>
            <h3 class="text-sm font-medium text-gray-900">Color</h3>

            <fieldset aria-label="Choose a color" class="mt-4">
              <div class="flex items-center gap-x-3">
                <!-- Active and Checked: "ring-3 ring-offset-1" -->
                <label aria-label="White" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-hidden">
                  <input type="radio" name="color-choice" value="White" class="sr-only">
                  <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-white"></span>
                </label>
                <!-- Active and Checked: "ring-3 ring-offset-1" -->
                <label aria-label="Gray" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-hidden">
                  <input type="radio" name="color-choice" value="Gray" class="sr-only">
                  <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-gray-200"></span>
                </label>
                <!-- Active and Checked: "ring-3 ring-offset-1" -->
                <label aria-label="Black" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-hidden">
                  <input type="radio" name="color-choice" value="Black" class="sr-only">
                  <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-gray-900"></span>
                </label>
              </div>
            </fieldset>
          </div>

          <!-- Sizes -->
          <div class="mt-10">
            <div class="flex items-center justify-between">
              <h3 class="text-sm font-medium text-gray-900">Size</h3>
              <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Size guide</a>
            </div>

            <fieldset aria-label="Choose a size" class="mt-4">
              <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-not-allowed items-center justify-center rounded-md border bg-gray-50 px-4 py-3 text-sm font-medium text-gray-200 uppercase hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="XXS" disabled class="sr-only">
                  <span>XXS</span>
                  <span aria-hidden="true" class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                    <svg class="absolute inset-0 size-full stroke-2 text-gray-200" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                      <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                    </svg>
                  </span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="XS" class="sr-only">
                  <span>XS</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="S" class="sr-only">
                  <span>S</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="M" class="sr-only">
                  <span>M</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="L" class="sr-only">
                  <span>L</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="XL" class="sr-only">
                  <span>XL</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="2XL" class="sr-only">
                  <span>2XL</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1 sm:py-6">
                  <input type="radio" name="size-choice" value="3XL" class="sr-only">
                  <span>3XL</span>
                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
              </div>
            </fieldset>
          </div>

          <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden">Add to bag</button>
        </form>
      </div>

      <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
        <!-- Description and details -->
        <div>
          <h3 class="sr-only">Description</h3>

          <div class="space-y-6">
            <p class="text-base text-gray-900">The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: &quot;Black&quot;. Need to add an extra pop of color to your outfit? Our white tee has you covered.</p>
          </div>
        </div>



      </div>
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
