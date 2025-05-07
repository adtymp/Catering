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
        <div x-data="{productOpen : false }" class="border-2 w-full p-4 rounded-md bg-white">
            <div class="flex justify-between items-center space-x-3">
                <h2 class="font-bold shadow-2xl">Product</h2>
                <div class="justify-center items-center">
                    <input type="text" placeholder="Cari Produk" class="p-1 bg-gray-100 rounded-l-lg">
                    <button class="bg-amber-400 text-white p-1 rounded-r-lg">Search</button>
                    <button class="bg-amber-400 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="#ffffff" d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                        </svg>
                    </button>
                </div>
                <button @click="productOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                    Tambah Produk
                </button>
            </div>
            <!--Modal-->
            <div x-show="productOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 w-100 max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-end">
                        <button @click="productOpen = false" class="text-gray-500 hover:text-red-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('productroom.product.add') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <h3 class="text-xl text-center font-bold text-amber-400">Tambah Produk</h3>
                        <div class="flex flex-col flex-grow mb-3">
                            <div x-data="{ productImage: [], removeFileImage(index) { this.productImage.splice(index, 1); } }"
                                class="block w-full py-2 px-3 bg-white border-2 border-gray-300 rounded-md relative">

                                <input name="image"
                                    type="file" accept="image/*"
                                    class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                                    @change="productImage = Array.from($event.target.files)">

                                <template x-if="productImage.length > 0">
                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <template x-for="(file, index) in productImage" :key="index">
                                            <div class="relative group border rounded p-2">
                                                <img :src="URL.createObjectURL(file)" class="w-full h-32 object-cover rounded">
                                                <button type="button"
                                                    @click="removeFileImage(index)"
                                                    class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full p-1 opacity-80 hover:opacity-100">
                                                    &times;
                                                </button>
                                                <p class="text-xs mt-1 truncate" x-text="file.name"></p>
                                            </div>
                                        </template>
                                    </div>
                                </template>

                                <template x-if="productImage.length === 0">
                                    <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600">
                                        <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i>
                                        <p>Drag and drop or click to select image files</p>
                                    </div>
                                </template>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Nama Produk</label>
                                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"">
                            </div>
                            <div>
                                <label class=" text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Kategori</label>
                                <div class="grid shrink-0 grid-cols-1 focus-within:relative">
                                    <select name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pr-7 pl-3 text-base placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 sm:text-sm/6">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Harga</label>
                                <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Deskripsi</label>
                                <div class="mt-2">
                                    <textarea name="deskripsi" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white py-2 mt-5 rounded-lg">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="mt-4 w-full table-auto">
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
                            <a href="#" class="text-blue-500 hover:text-blue-600">
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
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-600">
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
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>