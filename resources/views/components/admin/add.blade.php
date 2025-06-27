@props(['users'])
<div x-show="adminOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-end">
            <button @click="adminOpen = false" class="text-gray-500 hover:text-red-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.admin.add') }}" enctype="multipart/form-data" class="space-y-4">
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
            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700">Tambah Admin</button>
        </form>
    </div>
</div>