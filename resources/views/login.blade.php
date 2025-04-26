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
    <div x-data="authPage()" class="min-h-screen bg-gray-100 bg-cover" style="background-image: url('https://smallbizclub.com/wp-content/uploads/2018/10/How-the-Right-Software-Can-Supercharge-Your-Catering-Business.jpg')">
        <div class="flex min-h-screen items-center justify-center p-6">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <i x-show="isLogin" class="fas fa-sign-in-alt text-red-600 fa-lg"></i>
                        <i x-show="!isLogin" class="fas fa-user-plus text-red-600 fa-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        <span x-text="isLogin ? 'Welcome Back!' : 'Create Account'"></span>
                    </h2>
                    <p class="text-gray-600 mt-2">
                        <span x-text="isLogin ? 'Please sign in to continue' : 'Get started with your account'"></span>
                    </p>
                </div>

                <!-- LOGIN FORM -->
                <form x-show="isLogin" method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
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
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Sign In</button>
                </form>

                <!-- REGISTER FORM -->
                <form x-show="!isLogin" method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required x-model="confirmPassword" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none" placeholder="••••••••" />
                            <button type="button" class="absolute right-3 top-3 text-gray-400" @click="showConfirmPassword = !showConfirmPassword">
                                <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Create Account</button>
                </form>

                <!-- SWITCH FORM -->
                <p class="mt-6 text-center text-gray-600">
                    <span x-text="isLogin ? 'Don\'t have an account?' : 'Already have an account?'"></span>
                    <button type="button" class="ml-1 text-red-600 hover:text-red-700 font-semibold" @click="isLogin = !isLogin">
                        <span x-text="isLogin ? 'Sign up' : 'Sign in'"></span>
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