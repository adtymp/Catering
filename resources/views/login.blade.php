<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="fixed top-4 right-4 z-50 space-y-4">
        {{-- Success Toast --}}
        @if (session('success'))
        <div
            x-data="{ show: true}"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg relative w-80"
            role="alert">
            <strong class="font-bold">Sukses! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <button
                @click="show = false"
                class="absolute top-1 right-2 text-green-700">
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
                </svg>
            </button>
        </div>
        @endif

        {{-- Error Toast --}}
        @if ($errors->any())
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 6000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg relative w-80"
            role="alert">
            <strong class="font-bold">Terjadi kesalahan:</strong>
            <ul class="list-disc pl-5 text-sm mt-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button
                @click="show = false"
                class="absolute top-1 right-2 text-red-700">
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
                </svg>
            </button>
        </div>
        @endif
    </div>
    <div x-data="authPage()" class="min-h-screen bg-gray-100 bg-cover" style="background-image: url('https://smallbizclub.com/wp-content/uploads/2018/10/How-the-Right-Software-Can-Supercharge-Your-Catering-Business.jpg')">
        <div class="flex min-h-screen items-center justify-center p-6">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center mb-4">
                        <img src="{{ asset('logo/iconfullupdate (1).png') }}" alt="logo" class="w-40 h-40">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        <span x-text="isLogin ? 'Selamat Datang!' : 'Buat Akun'"></span>
                    </h2>
                    <p class="text-gray-600 mt-2">
                        <span x-text="isLogin ? 'Silahkan login untuk melanjutkan' : 'Mulai dengan membuat akun'"></span>
                    </p>
                </div>

                <!-- LOGIN FORM -->
                <form x-show="isLogin" method="POST" action="{{ route('admin.login.process') }}" class="space-y-5">
                    @csrf
                    @if($errors->any())
                    <div class="text-center text-red-600 alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required x-model="email" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="you@example.com" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" required x-model="password" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="••••••••" />
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Masuk</button>
                </form>

                <div class="justify-center flex p-2">
                    <a href="{{ route('google_redirect') }}" class="bg-gradient-to-r from-blue-700 to-red-700 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700">
                        Login Dengan Google
                        <i class="fab fa-google ml-2"></i>
                    </a>
                </div>

                <!-- REGISTER FORM -->
                <form x-show="!isLogin" method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required x-model="name" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="John Doe" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required x-model="email" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="you@example.com" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" required x-model="password" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="••••••••" />
                            <button type="button" class="absolute right-3 top-3 text-gray-400" @click="showPassword = !showPassword">
                                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required x-model="confirmPassword" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="••••••••" />
                            <button type="button" class="absolute right-3 top-3 text-gray-400" @click="showConfirmPassword = !showConfirmPassword">
                                <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Buat Akun</button>
                </form>

                <!-- SWITCH FORM -->
                <p class="mt-6 text-center text-gray-600">
                    <span x-text="isLogin ? 'Belum punya akun?' : 'Sudah punya akun?'"></span>
                    <button type="button" class="ml-1 text-red-600 hover:text-red-700 font-semibold" @click="isLogin = !isLogin">
                        <span x-text="isLogin ? 'Daftar' : 'Masuk'"></span>
                    </button>
                </p>
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