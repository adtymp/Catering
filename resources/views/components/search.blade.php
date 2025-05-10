<div class="text-center">
    <div class="p-4">
        <form x-data="{ open: false, selected: '{{ request('filter') }}' }" method="GET" action="{{ route('filterSearch') }}" class="inline-flex items-center gap-2">
            <!-- Input Search -->
            <input name="query" value="{{ request('query') }}" type="search" placeholder="Cari Produk"
                class="bg-gray-100 outline-none border rounded-s p-2">

            <!-- Dropdown Filter -->
            <div class="relative inline-block text-left">
                <button @click="open = !open" type="button"
                    class="inline-flex justify-center items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50"
                    aria-expanded="true" aria-haspopup="true">
                    <span x-text="selected ? selected : 'Filter Harga'"></span>
                    <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Options -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5">
                    <ul class="py-1">
                        <template x-for="(opt, idx) in [
                            { label: 'Tampilkan Semua', slug: '' },
                            { label: 'Dibawah 15 000',  slug: 'under-15000' },
                            { label: '15 000 – 25 000', slug: '15-25k' },
                            { label: '25 000 – 50 000', slug: '25-50k' }
                        ]" :key="idx">
                            <li>
                                <button type="button"
                                    @click="selected = opt.slug; open = false"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    x-text="opt.label"></button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>

            <!-- Hidden Input for Selected Filter -->
            <input type="hidden" name="filter" :value="selected">

            <!-- Submit Button -->
            <button type="submit" class="p-2 px-4 bg-red-700 text-white rounded-e hover:bg-red-800">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>