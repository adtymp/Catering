<div class="flex">
    <!-- Sidebar -->
    <div
        x-show="sidebarOpen"
        x-transition
        class="h-screen w-48 fixed bg-white border-e-2 shadow-xl border-gray-200 z-30">
        <!-- Sidebar content -->
        <div class="p-4 font-black text-amber-400">LOGO</div>
        <a href="admindashboard" class="relative flex items-center text-gray-400 hover:text-white hover:bg-black p-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 576 512">
                <path fill="#e1c356" d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z" />
            </svg>
            <h1 class="px-2">Dashboard</h1>
        </a>
        <div class="relative flex items-center text-gray-400 hover:text-white hover:bg-black p-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 448 512">
                <path fill="#e1c356" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
            </svg>
            <h1 class="px-2">Admin</h1>
        </div>
        <a href="product" class="relative flex items-center text-gray-400 hover:text-white hover:bg-black p-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                <path fill="#e1c356" d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1 43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32L8.6 224C3.1 214.6 0 203.7 0 192zm0 91.4C0 268.3 12.3 256 27.4 256l457.1 0c15.1 0 27.4 12.3 27.4 27.4c0 70.5-44.4 130.7-106.7 154.1L403.5 452c-2 16-15.6 28-31.8 28l-231.5 0c-16.1 0-29.8-12-31.8-28l-1.8-14.4C44.4 414.1 0 353.9 0 283.4z" />
            </svg>
            <h1 class="px-2">Produk</h1>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="relative flex items-center text-gray-400 hover:text-white hover:bg-black p-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                    <path fill="#e1c356" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                </svg>
                <h1 class="px-2">Logout</h1>
            </button>
        </form>
    </div>

    <div class="flex-1" x-data="{ isOpen: false }">
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="fixed top-4 left-48 z-40 p-2 bg-white border-gray-200 shadow-xl border-2 rounded-r-md transition-all duration-300"
            :class="{ 'left-48': sidebarOpen, 'left-2': !sidebarOpen }">
            <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 192 512">
                <path fill="#e1c356" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64L0 448c0 17.7 14.3 32 32 32s32-14.3 32-32L64 64zm128 0c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 384c0 17.7 14.3 32 32 32s32-14.3 32-32l0-384z" />
            </svg>
        </button>

        <div
            class="fixed top-0 right-0 h-16 bg-white shadow flex items-center justify-between px-4 transition-all duration-300 z-20"
            :class="sidebarOpen ? 'ml-48 w-[calc(100%-12rem)]' : 'ml-0 w-full'">

            <h1 class="pl-10 text-xl font-semibold text-gray-800">Dashboard</h1>

            <div class="flex items-center space-x-2">
                @if (Auth::check())
                <span class="text-gray-700 font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                @endif
                <button @click="isOpen = !isOpen" class="w-9 h-9 rounded-full bg-yellow-100 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="#e1c356">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="isOpen"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="origin-top-right absolute top-16 right-0 mt-2 w-56 rounded-md shadow-lg bg-white z-50 ring-1 ring-black/5 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button"
                    tabindex="-1">

                    <!-- Your Profile -->
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Your Profile</a>
                    <!-- Settings -->
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Settings</a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 w-full text-left" role="menuitem" tabindex="-1">
                            Sign out
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>