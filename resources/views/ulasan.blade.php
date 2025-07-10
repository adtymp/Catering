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
    <title>Ulasan</title>
</head>

<body class="bg-gray-100">
    <x-navbar :categories="$categories" :cartCount="$cartCount" />

    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Header Ulasan -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Ulasan Produk</h2>
            <div class="flex items-center">
                <!-- Rating Average -->
                <div class="flex items-center px-4 py-2 rounded-lg">
                    <div class="flex items-center mr-3">
                        @php
                        $averageRating = $rates->avg('rate');
                        $fullStars = floor($averageRating);
                        $hasHalfStar = $averageRating - $fullStars >= 0.5;
                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                        @endphp

                        @for($i = 0; $i < $fullStars; $i++)
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor

                            @if($hasHalfStar)
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <defs>
                                    <linearGradient id="half-star" x1="0" x2="100%" y1="0" y2="0">
                                        <stop offset="50%" stop-color="currentColor" />
                                        <stop offset="50%" stop-color="#d1d5db" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endif

                            @for($i = 0; $i < $emptyStars; $i++)
                                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                    </div>
                    <span class="text-gray-800 font-medium">{{ number_format($averageRating, 1) }} <span class="text-gray-600">({{ $rates->total() }} ulasan)</span></span>
                </div>
            </div>
        </div>

        <!-- Filter Ulasan -->
        <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
            @php
            $ratingCounts = [
            'all' => $rates->total(),
            5 => $rates->where('rate', 5)->count(),
            4 => $rates->where('rate', 4)->count(),
            3 => $rates->where('rate', 3)->count(),
            2 => $rates->where('rate', 2)->count(),
            1 => $rates->where('rate', 1)->count()
            ];
            @endphp

            <form method="GET" action="{{ request()->url() }}" class="flex space-x-2">
                <!-- Filter Semua -->
                <button
                    type="submit"
                    name="filter"
                    value="all"
                    class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors duration-200
                    {{ request('filter', 'all') === 'all' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white border-gray-300 text-gray-700 border' }}">
                    Semua Ulasan ({{ $ratingCounts['all'] }})
                </button>

                <!-- Filter per Rating -->
                @foreach([5,4,3,2,1] as $rating)
                <button
                    type="submit"
                    name="filter"
                    value="{{ $rating }}"
                    class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors duration-200
                        {{ request('filter') == $rating ? 'bg-blue-600 text-white border-blue-600' : 'bg-white border-gray-300 text-gray-700 border' }}">
                    {{ $rating }} Bintang ({{ $ratingCounts[$rating] }})
                </button>
                @endforeach
            </form>
        </div>

        <!-- Daftar Ulasan -->
        <div class="space-y-6">
            @forelse ($rates as $rate)
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex justify-between items-start">
                    <div class="flex items-start">
                        <div class="ml-3">
                            <h4 class="font-medium text-gray-800">{{ $rate->user->name }}</h4>
                            <div class="flex items-center mt-1">
                                <!-- Rating Stars -->
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=$rate->rate)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        @else
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        @endif
                                        @endfor
                                        <span class="ml-1 text-gray-600 text-sm">{{ number_format($rate->rate, 1) }}</span>
                                </div>

                                <!-- Formatted Date -->
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-gray-500 text-sm" title="{{ $rate->created_at->format('d M Y H:i') }}">
                                    {{ $rate->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Options Button -->
                    <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </div>

                <!-- Comment -->
                <div class="mt-4 pl-1">
                    <p class="text-gray-700 leading-relaxed">{{ $rate->comment }}</p>
                </div>

                <!-- Payment Info (optional) -->
                @if($rate->payment)
                <div class="mt-3 pt-3 border-t border-gray-100 text-sm text-gray-500">
                    Pembayaran • {{ $rate->payment->created_at->format('d M Y') }}
                </div>
                @endif
            </div>
            @empty
            <div class="text-center p-8 bg-white rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-600">Belum Ada Ulasan</h3>
                <p class="mt-1 text-gray-500">Jadilah yang pertama memberikan ulasan</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination / Load More -->
        @if($rates->hasPages())
        <div class="mt-8">
            {{ $rates->links('pagination::tailwind') }}
        </div>
        @elseif($rates->count() > 5)
        <div class="mt-8 text-center">
            <button class="px-6 py-2 border border-gray-300 rounded-full font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Lihat Lebih Banyak Ulasan
            </button>
        </div>
        @endif
    </div>

    <!-- Form Ulasan (Fixed Bottom) -->
    @auth
    @foreach ($paymentCount as $payment)
    <div class="fixed bottom-0 w-full bg-white shadow-lg border-t border-gray-200 z-50">
        <div class="max-w-4xl mx-auto flex items-center justify-between p-4">
            <form action="{{ route('ulasan.add') }}" method="POST" class="w-full flex">
                @csrf
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">

                <div class="flex-1 mr-4">
                    <input class="w-full px-4 py-3 ring-1 ring-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text"
                        placeholder="Tulis Ulasanmu disini..."
                        name="comment"
                        required>
                </div>

                <div class="flex items-center space-x-2">
                    <!-- Rating Stars -->
                    <div
                        x-data="{
                        rating: 0,
                        tempRating: 0,
                        icons: [1,2,3,4,5],
                        rate(i) {
                        this.rating = i;
                            },
                            mouseOver(i) {
                                this.tempRating = i;
                            },
                            mouseOut() {
                                this.tempRating = 0;
                            },
                            getColor(i) {
                                if (this.tempRating >= i) {
                                    return 'text-yellow-400';
                                } else if (this.rating >= i) {
                                    return 'text-yellow-400';
                                } else {
                                    return 'text-gray-300';
                                }
                            }
                        }"
                        class="flex items-center">
                        <template x-for="i in icons" :key="i">
                            <button
                                type="button"
                                @click="rate(i)"
                                @mouseover="mouseOver(i)"
                                @mouseout="mouseOut()"
                                class="relative focus:outline-none transition-all duration-200 transform hover:scale-125">
                                <span
                                    class="text-3xl"
                                    :class="getColor(i)">
                                    ★
                                </span>
                            </button>
                        </template>
                        <input type="hidden" name="rate" x-model="rating" required>
                        <span x-show="rating > 0" class="ml-2 text-gray-600" x-text="rating + ' bintang'"></span>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    @endauth
</body>

</html>