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
        <h1>Ini adalah Halaman Produk</h1>

        <!-- Container besar -->
        <div class="flex flex-col md:flex-row gap-6 p-4">
            <!-- Postingan -->
            <div  x-data="{ postOpen: false }" class="border-2 w-full md:w-1/2 p-4 rounded-md bg-white shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Postingan</h2>
                    <button @click="postOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                        Tambah Postingan
                    </button>
                </div>

                <!-- Modal Postingan -->
                <div x-show="postOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg w-80">
                        <div class="flex justify-end">
                            <button @click="postOpen = false" class="text-gray-500 hover:text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <h3 class="text-xl font-bold text-amber-400">Tambah Postingan</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Judul</label>
                                <input type="text" name="name" class="w-full mt-1 p-2 border rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                <input type="file" name="image" class="w-full mt-1" accept="image/*" required>
                            </div>
                            <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white py-2 rounded-lg">
                                Add
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Table Postingan -->
                <table class="w-full mt-4 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Judul</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- foreach($posts as $index => $post) -->
                        <tr class="border-t">
                            <td class="px-4 py-2">index + 1</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2 text-blue-500"><a href="#">Edit</a></td>
                        </tr>
                        <!-- endforeach -->
                    </tbody>
                </table>
            </div>

            <!-- Kategori -->
            <div x-data="{ kategoriOpen: false }" class="border-2 w-full md:w-1/2 p-4 rounded-md bg-white shadow-md">
                <div  class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Kategori</h2>
                    <button @click="kategoriOpen = true" class="bg-amber-400 hover:bg-amber-500 text-white rounded-lg px-4 py-2">
                        Tambah Kategori
                    </button>
                </div>

                <!-- Modal Kategori -->
                <div x-show="kategoriOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg w-80">
                        <div class="flex justify-end">
                            <button @click="kategoriOpen = false" class="text-gray-500 hover:text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('productroom.add') }}" class="space-y-4">
                            @csrf
                            <h3 class="text-xl font-bold text-amber-400">Tambah Kategori</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                                <input type="text" name="name" class="w-full mt-1 p-2 border rounded-lg" required>
                            </div>
                            <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white py-2 rounded-lg">
                                Add
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Table Kategori -->
                <table class="w-full mt-4 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama Kategori</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2 text-blue-500"><a href="#">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tambahkan Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


        <!--produk-->
        <div class="border-2 w-max p-2 rounded-md bg-white">
            <div class="flex items-center justify-center text-center p-2 space-x-3">
                <input class="p-1 bg-gray-100 rounded-l-lg" placeholder="Cari Produk" type="text" name="name">
                <button class="bg-amber-400 p-1 rounded-r-lg">Search</button>
                <div x-data="{ open: false }">
                    <button @click="open = true" class="block bg-gray-100 hover:bg-red-900 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button" data-modal-toggle="authentication-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 448 512">
                            <path fill="#e1c356" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>
                    </button>
                    <div x-show="open" class="fixed top-0 left-0 w-full h-screen bg-black/50 flex justify-center items-center">
                        <div class="p-4 w-1/2 bg-white rounded-lg border-gray-200 shadow-md">
                            <div class="flex justify-end p-1">
                                <button @click="open= false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <h3 class="p-6 text-xl font-bold text-amber-400 dark:text-white">Tambahkan Produk</h3>
                                <form action="">
                                    <!--Gambar-->
                                    <div class="relative border-2 border-gray-300 border-dashed rounded-lg p-0" id="dropzone">
                                        <input type="file" name="image" id="file-upload" class="absolute inset-0 w-full h-full opacity-0 z-50" />
                                        <div class="text-center">
                                            <img class="mx-auto h-6 w-6" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="Upload">

                                            <h3 class="text-sm font-medium text-gray-900">
                                                <label for="file-upload" class="relative cursor-pointer">
                                                    <span>Drag and drop</span>
                                                    <span class="text-indigo-600"> or browse</span>
                                                    <span>to upload</span>
                                                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                                </label>
                                            </h3>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 5MB
                                            </p>
                                        </div>
                                        <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
                                    </div>
                                    <script>
                                        var dropzone = document.getElementById('dropzone');

                                        dropzone.addEventListener('dragover', e => {
                                            e.preventDefault();
                                            dropzone.classList.add('border-indigo-600');
                                        });

                                        dropzone.addEventListener('dragleave', e => {
                                            e.preventDefault();
                                            dropzone.classList.remove('border-indigo-600');
                                        });

                                        dropzone.addEventListener('drop', e => {
                                            e.preventDefault();
                                            dropzone.classList.remove('border-indigo-600');
                                            var file = e.dataTransfer.files[0];
                                            displayPreview(file);
                                        });

                                        var input = document.getElementById('file-upload');

                                        input.addEventListener('change', e => {
                                            var file = e.target.files[0];
                                            displayPreview(file);
                                        });

                                        function displayPreview(file) {
                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = () => {
                                                var preview = document.getElementById('preview');
                                                preview.src = reader.result;
                                                preview.classList.remove('hidden');
                                            };
                                        }
                                    </script>
                                    <!--Nama-->
                                    <div>
                                        <label for="nama_produk" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Name Product</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <!--Kategori-->
                                    <div>
                                        <label for="kategori" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Kategori</label>
                                        <main class="flex w-full">
                                            <div x-data="select" class="relative w-[30rem]" @click.outside="open = false">
                                                <button @click="toggle" :class="(open)" class="flex w-full items-center justify-between rounded-lg bg-gray-50 border border-gray-300 p-2 sm:text-sm">
                                                    <span x-text="(language == '') ? 'Pilih Kategori' : language"></span>
                                                    <i class="fas fa-chevron-down text-xl"></i>
                                                </button>

                                                <ul class="z-2 absolute mt-1 w-full rounded bg-gray-50 ring-1 ring-gray-300 sm:text-sm" x-show="open">
                                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Baju')">Baju</li>
                                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Celana')">Celana</li>
                                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Sepatu')">Sepatu</li>
                                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Aksesoris')">Aksesoris</li>
                                                </ul>
                                                <input type="hidden" name="kategori" x-model="language">
                                            </div>
                                        </main>
                                        <script>
                                            document.addEventListener("alpine:init", () => {
                                                Alpine.data("select", () => ({
                                                    open: false,
                                                    language: "",

                                                    toggle() {
                                                        this.open = !this.open;
                                                    },

                                                    setLanguage(val) {
                                                        this.language = val;
                                                        this.open = false;
                                                    },
                                                }));
                                            });
                                        </script>
                                    </div>
                                    <!--Harga-->
                                    <div>
                                        <label for="price" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Price</label>
                                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
                                    </div>
                                    <button type="submit" class=" p-6 w-full text-white bg-amber-400 hover:bg-amber-900 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table-auto">
                <tr class="border-b-2">
                    <th class="w-10 px-4 py-2">No. </th>
                    <th class="px-4 py-2">Nama Produk</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Edit</th>
                </tr>
                <tr class="border-b-2">
                </tr>
            </table>
        </div>
    </div>
</body>

</html>