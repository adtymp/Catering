<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow p-4">
        <!-- Wrapper tengah -->
        <div class="flex justify-center">
            <!-- Form filter dan search -->
            <form x-data="{ open: false, selected: '{{ request('filter') }}' }"
                  method="GET" action="{{ route('filterSearch') }}"
                  class="w-full max-w-3xl flex flex-col sm:flex-row sm:items-center sm:gap-4 gap-3">
                
                <!-- Input Search -->
                <input name="query" value="{{ request('query') }}" type="search"
                    placeholder="Cari Produk"
                    class="w-full sm:w-60 bg-gray-100 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

                <!-- Dropdown Filter -->
                <div class="relative w-full sm:w-60">
                    <button @click="open = !open" type="button"
                        class="w-full flex justify-between items-center bg-white border border-gray-300 rounded-md px-4 py-2 shadow-sm text-gray-800 font-medium hover:bg-gray-50 focus:outline-none">
                        <span x-text="selected ? selected.replace('-', ' ') : 'Filter Harga'"></span>
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06 0L10 10.91l3.72-3.7a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Options -->
                    <div x-show="open" @click.away="open = false"
                        x-transition
                        class="absolute z-10 mt-2 w-full bg-white border border-gray-200 rounded-md shadow-lg">
                        <ul class="py-1">
                            <template x-for="(opt, idx) in [
                                { label: 'Tampilkan Semua', slug: '' },
                                { label: 'Dibawah 15.000',  slug: 'under-15000' },
                                { label: '15.000 – 25.000', slug: '15-25k' },
                                { label: '25.000 – 50.000', slug: '25-50k' }
                            ]" :key="idx">
                                <li>
                                    <button type="button"
                                        @click="selected = opt.slug; open = false"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100"
                                        x-text="opt.label">
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                <!-- Hidden Input -->
                <input type="hidden" name="filter" :value="selected">

                <!-- Submit -->
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-md font-semibold transition">
                    <i class="fa fa-search mr-2"></i>Cari
                </button>
            </form>
        </div>
    </div>
</div>