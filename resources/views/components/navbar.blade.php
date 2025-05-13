@props(['categories', 'cartCount'])
<div class="bg-red-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="/" class="rounded-md px-3 py-2 text-sm font-medium text-white flex">
                        <div class="text-yellow-300 text-3xl font-bold">LOGO</div>
                    </a>
                </div>
                <!-- resources/views/components/navbar.blade.php -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <div x-data="{ menuOpen: false }" class="relative">
                            <button
                                @click="menuOpen = !menuOpen"
                                class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">
                                Menu
                            </button>

                            <div
                                x-show="menuOpen"
                                @click.away="menuOpen = false"
                                x-transition
                                class="absolute z-10 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black/5">
                                <ul class="py-2">
                                    @foreach($categories as $category)
                                    <li class="flex items-center px-4 py-2 hover:bg-amber-100">
                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-6 h-6 object-cover mr-2 rounded">
                                        <span class="text-gray-800 text-sm">{{ $category->name }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <!-- Menu lainnya -->
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Cara Pesan</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Ulasan</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Tentang Kami</a>
                    </div>
                </div>

            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <a href="{{ route('cart') }}" class="relative p-1 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="#fff000" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                        </svg>
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-white text-red-800 text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Profile dropdown -->
                    <div class="relative inline-block ml-3">
                        <div>
                            <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full ring-red-700 text-sm hover:ring-2 hover:ring-yellow-300 z-10" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff000" class="size-8">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                </svg>

                            </button>
                        </div>
                        <div x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-red-800 z-50 ring-yellow-300 ring-1"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">

                            <!-- Your Profile -->
                            @auth
                            <a href="#" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Your Profile</a>
                            <!-- Settings -->
                            <a href="#" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Settings</a>
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800 w-full text-left" role="menuitem" tabindex="-1">
                                    Sign out
                                </button>
                            </form>
                            @endauth

                            @guest
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Login</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-red-800 p-2 text-yellow-300 hover:bg-yellow-300 hover:text-red-800  ring-2 ring-yellow-300" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="#fff000" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="#fff000" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-white hover:bg-gray-700 hover:text-white" -->
            <!-- <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a> -->
            <button class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Menu</button>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Cara Pesan</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Ulasan</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-yellow-300 hover:text-red-800 hover:bg-yellow-300">Tentang Kami</a>
        </div>
        <div class="border-t border-yellow-300 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base/5 font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                </div>
                <button type="button" class="relative ml-auto shrink-0 rounded-full bg-yellow-100 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
                @auth
                <a href="#" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Your Profile</a>
                @else
                <a href="#" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Login</a>
                @endauth
                <!-- Settings -->
                <a href="#" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800" role="menuitem" tabindex="-1">Settings</a>
                <!-- Logout -->
                @auth
                <form method="POST" action="#" class="block">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-yellow-300 hover:bg-yellow-300 hover:text-red-800 w-full text-left" role="menuitem" tabindex="-1">Sign out</button>
                </form>
                @endauth

            </div>
        </div>
    </div>
</div>
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