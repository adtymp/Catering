<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: true }" class="relative">
    <x-sidebar></x-sidebar>
    <!--main-->
    <div class="transition-all duration-300 p-4 pt-20"
        :class="sidebarOpen ? 'pl-52' : 'pl-12'" class="h-screen absolute top-0 ml-48 p-2 w-full bg-gray-100">
        @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <strong class="font-bold">Sukses! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <button
                @click="show = false"
                class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700">
                <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
                </svg>
            </button>
        </div>
        @endif
        @if($errors->any())
        <div class="text-center text-red-600 alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Container besar -->
        <div class="flex flex-col md:flex-row gap-6 p-4">

            <!-- Postingan -->
            <div x-data="{ postOpen: {{ $editBanner ? 'true' : 'false' }} }" class="border-2 w-full md:w-1/2 p-4 rounded-md bg-white shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Postingan</h2>
                    <button @click="postOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                        Tambah Postingan
                    </button>
                </div>

                <!-- Modal Postingan -->
                <x-Banner.add></x-Banner.add>
                <!-- Table Postingan -->
                <table class="w-full mt-4 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Judul</th>
                            <th class="px-4 py-2">Edit</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr class="border-t">
                            <td class="px-4 py-2 w-8 h-8">
                                <img class="w-10 h-8" src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->tittle }}">
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-4">
                                    <div x-data="{ editPost : false }">
                                        <button @click="editPost = true" class="text-blue-500 hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-1"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <p>Edit</p>
                                        </button>
                                        <x-banner.edit :banner="$banner"></x-banner.edit>
                                    </div>
                                    <div x-data="{ showConfirmDelete: false }">
                                        <button @click="showConfirmDelete = true" class="text-red-500 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-1 ml-3"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p>Delete</p>
                                        </button>
                                        <x-banner.delete :banner="$banner"></x-banner.delete>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Kategori -->
            <div x-data="{ kategoriOpen: false }" class="border-2 w-full md:w-1/2 p-4 rounded-md bg-white shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Kategori</h2>
                    <button @click="kategoriOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                        Tambah Kategori
                    </button>
                </div>

                <!-- Modal Kategori -->
                <x-category.add></x-category.add>

                <!-- Table Kategori -->
                <table class="w-full mt-4 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Icon</th>
                            <th class="px-4 py-2">Nama Kategori</th>
                            <th class="px-4 py-2">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                <img class="w-8 h-8" src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}">
                            </td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-4">
                                    <div x-data="{ editCategory : false }">
                                        <button @click="editCategory = true" class="text-blue-500 hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-1"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <p>Edit</p>
                                        </button>
                                        <x-category.edit :kategori="$category"></x-category.edit>
                                    </div>
                                    <div x-data="{ deleteCategory: false }">
                                        <button @click="deleteCategory = true" class="text-red-500 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-1 ml-3"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p>Delete</p>
                                        </button>
                                        <x-category.delete :kategori="$category"></x-category.delete>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--produk-->
        <div x-data="{productOpen : false }" class="border-2 w-full p-4 rounded-md bg-white shadow-md">
            <div class="flex justify-between items-center space-x-3">
                <h2 class="font-bold shadow-2xl">Product</h2>
                <div class="justify-center items-center">
                    <!-- Form Search -->
                    <form method="GET" action="{{ route('productroom') }}" class="inline-flex">
                        <input type="text" name="search" placeholder="Cari Produk" class="p-1 bg-gray-100 rounded-l-lg" value="{{ request('search') }}">
                        <button type="submit" class="bg-amber-400 text-white p-1 rounded-r-lg">Search</button>
                    </form>

                    <!-- Dropdown Filter Kategori -->
                    <div x-data="{ openFilter: false }" class="relative inline-block">
                        <button @click="openFilter = !openFilter" class="bg-amber-400 p-2 rounded-lg ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                                <path fill="#ffffff" d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                            </svg>
                        </button>

                        <div x-show="openFilter" @click.away="openFilter = false" class="absolute z-10 mt-2 w-40 bg-white border rounded shadow-lg">
                            <template x-for="category in categories" :key="category.id">
                                <a
                                    :href="'{{ route('productroom') }}' + '?category=' + category.id"
                                    x-text="category.name"
                                    class="block px-4 py-2 hover:bg-gray-100 text-left">
                                </a>
                            </template>
                            <a href="{{ route('productroom') }}" class="block w-full text-left px-4 py-2 text-gray-500 hover:bg-gray-100">Semua Kategori</a>
                        </div>
                    </div>
                </div>

                <button @click="productOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                    Tambah Produk
                </button>
            </div>
            <!--Modal-->
            <x-product.add :categories="$categories" />
            <div class="overflow-x-auto overflow-y-auto h-[300px] mt-4">
                <table class="w-full table-auto">
                    <tr class="border-b-2">
                        <th class="w-10 px-4 py-2">No. </th>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Edit</th>
                    </tr>
                    @foreach($products as $product)
                    <tr class="border-b-2">
                        <td class="w-10 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2 w-5 h-5">
                            <img src="{{ asset('storage/' . $product->image) }}">
                        </td>
                        <td class="px-4 py-2">{{ $product->category->name }}</td>
                        <td class="px-4 py-2">{{ $product->deskripsi }}</td>
                        <td class="px-4 py-2">{{ $product->price }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-4">
                                <div x-data="{ editProduct : false }">
                                    <button @click="editProduct = true" class="text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-1"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <p>Edit</p>
                                    </button>
                                    <x-product.edit :product="$product" :categories="$categories"></x-product.edit>
                                </div>
                                <div x-data="{ deleteProduct : false }">
                                    <button @click="deleteProduct = true" class="text-red-500 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-1 ml-3"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <p>Delete</p>
                                    </button>
                                    <x-product.delete :product="$product"></x-product.delete>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>