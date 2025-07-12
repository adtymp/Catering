<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Cara Pesan</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-red-700 py-8 shadow-lg">
            <div class="container mx-auto px-4 sm:px-6">
                <h2 class="text-3xl md:text-4xl text-white font-bold text-center">Cara Pemesanan di Catering Cangkir Cakning</h2>
                <p class="text-center text-red-100 mt-2 text-lg">Panduan langkah demi langkah untuk memesan dengan mudah</p>
            </div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 py-12 max-w-4xl">
            <div class="space-y-12">
                @php
                $daftarLangkah = [
                [
                'nomor' => 1,
                'judul' => "Awal",
                'deskripsi' => "Pastikan anda menambahkan alamat terlebih dahulu",
                'gambar' => "langkah/web/langkah1.png"
                ],
                [
                'nomor' => 2,
                'judul' => "Menuju Profile",
                'deskripsi' => "Pilih ke halaman profile",
                'gambar' => "langkah/web/langkah2.png"
                ],
                [
                'nomor' => 3,
                'judul' => "Pilih Tambah Alamat",
                'deskripsi' => "Klik tambah alamat terlebih dahulu",
                'gambar' => "langkah/web/langkah3.png"
                ]
                ];
                @endphp

                @foreach($daftarLangkah as $langkah)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <!-- Content -->
                    <div class="p-6 sm:p-8">
                        <div class="flex items-start gap-4">
                            <!-- Number Badge -->
                            <div class="bg-red-700 text-white w-12 h-12 flex items-center justify-center text-xl font-bold shrink-0 rounded-full">
                                {{ $langkah['nomor'] }}
                            </div>

                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">
                                    {{ $langkah['judul'] }}
                                </h3>
                                <p class="text-gray-600">{{ $langkah['deskripsi'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="w-full px-6 pb-6 sm:px-8 sm:pb-8">
                        <div class="border-t border-gray-200 pt-6">
                            <img src="{{ asset($langkah['gambar']) }}"
                                alt="Langkah {{ $langkah['nomor'] }}"
                                class="rounded-lg shadow-sm w-full h-auto border border-gray-200">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center bg-gradient-to-r from-red-600 to-red-700 rounded-xl p-8 text-white shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Siap Memesan?</h3>
                <p class="mb-6 mx-auto">Mulai pesanan Anda sekarang dan nikmati hidangan lezat dari Catering Cangkir Cakning</p>
                <a href="#" class="inline-block bg-white text-red-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors text-sm sm:text-base">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
</body>

</html>