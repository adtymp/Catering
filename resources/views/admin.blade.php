<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Admin Room</title>
</head>

<body>

    <body x-data="{ sidebarOpen: true }" class="relative">
        <x-sidebar></x-sidebar>
        <!--main-->
        <div class="transition-all duration-300 p-4 pt-20"
            :class="sidebarOpen ? 'pl-64' : 'pl-12'" class="h-screen absolute top-0 ml-48 p-2 w-full bg-gray-100">
            <!-- Container besar -->
            <h1 class="text-2xl text-center text-black font-bold mb-5">Daftar Admin</h1>
            <div x-data="{ adminOpen : false }" class="border-2 w-full p-4 rounded-md bg-white shadow-md">
                <button @click="adminOpen = true" class="px-4 py-2 rounded-lg bg-amber-400">Tambah Admin</button>

                <x-admin.add :users="$users"></x-admin.add>

                <div class="flex flex-col md:flex-row gap-6 p-4">
                    <table class="w-full mt-4 table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $admin )
                            @if($admin->hasRole('admin'))
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $admin->name }}</td>
                                <td class="px-4 py-2">{{ $admin->email }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-4 justify-center">
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
                                        </div>
                                        <div x-data="{ deleteAdmin : false }">
                                            <button @click="deleteAdmin = true" class="text-red-500 hover:text-red-800">
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
                                            <x-admin.delete :admin="$admin"></x-admin.delete>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('authPage', () => ({
                    isLogin: true,
                    showPassword: false,
                    showConfirmPassword: false,
                    email: '',
                    password: '',
                    confirmPassword: '',
                    name: ''
                }));
            });
        </script>
    </body>
</html>