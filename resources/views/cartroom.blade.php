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
    <title>CartRoom</title>
</head>

<body>
    <x-navbar :categories="$categories" :cartCount="$cartCount" />
    <a href="{{ route('welcome')}}">
        <button class="px-5 py-3 items-center ml-5 rounded-lg flex hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path fill="#000000" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            <h2 class="ml-5 text-3xl">Back</h2>
        </button>
    </a>
    <a href="https://wa.me/628815074046"
        class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg z-50"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Hubungi kami via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 448 512">
            <path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
        </svg>
    </a>

    <form id="checkout-form" action="{{ route('payment.checkout') }}" method="GET">
        @csrf
        <div class="p-6 max-w-4xl mx-auto space-y-4 mb-32">
            <h1 class="text-3xl font-bold text-center mb-6">KERANJANGMU</h1>
            <div class="flex items-center mb-2">
                <input type="checkbox" id="select-all" class="mr-2">
                <label for="select-all" class="text-gray-700 font-medium">Pilih Semua</label>
            </div>
            @forelse ($carts as $cart)
            <div class="bg-white rounded-lg shadow-md p-4 flex gap-4 items-center">
                <input type="checkbox" name="cart_items[]" value="{{ $cart->id }}" class="mt-2 select-cart-item">
                <img src="{{ asset('storage/' . $cart->product->image) }}" alt="Product" class="w-28 h-28 object-cover rounded-md">
                <div class="flex-1">
                    <div class="justify-between flex items-center">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $cart->product->name }}</h2>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $cart->product->deskripsi }}</p>
                            <p class="text-sm text-gray-500 line-clamp-2">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                        </div>
                        <!-- Tombol hapus -->
                        <button type="button"
                            onclick="submitDelete({{ $cart->id }})"
                            class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-1 ml-3"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-red-500 line-clamp-2 item-price"
                            data-unit-price="{{ $cart->product->price }}"
                            data-cart-id="{{ $cart->id }}">
                            Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center mt-2 space-x-2 quantity-control" data-cart-id="{{ $cart->id }}">
                            <button type="button" class="minus-btn bg-gray-200 px-2 py-1 rounded">-</button>
                            <span class="quantity-span">{{ $cart->quantity }}</span>
                            <input type="number" class="quantity-input hidden w-12 text-center" min="1" value="{{ $cart->quantity }}">
                            <button type="button" class="plus-btn bg-gray-200 px-2 py-1 rounded">+</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500">Keranjangmu masih kosong.</p>
            @endforelse

            @guest
            <p class="text-center text-gray-500">Login untuk melihat halaman ini.</p>
            @endguest
        </div>

        <div class="fixed bottom-0 w-full bg-white shadow-lg border-t border-gray-200 z-50">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <div class="p-4">
                    <p class="text-gray-600 text-sm">Total Harga</p>
                    <h2 class="text-xl font-bold text-gray-900" id="totalHarga">Rp 0</h2>
                </div>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </form>

    <!-- Form hapus tersembunyi -->
    @foreach ($carts as $cart)
    <form id="delete-form-{{ $cart->id }}" action="{{ route('cart.delete', $cart->id) }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endforeach

    <script>
        function updateItemPrice(cartId, newQuantity) {
            const itemPriceElement = document.querySelector(`.item-price[data-cart-id="${cartId}"]`);
            if (itemPriceElement) {
                const unitPrice = parseFloat(itemPriceElement.dataset.unitPrice);
                const newPrice = unitPrice * newQuantity;
                itemPriceElement.textContent = `Rp ${newPrice.toLocaleString('id-ID')}`;
            }
        }
        // Fungsi untuk update quantity
        function updateQuantity(cartId, newQuantity) {
            // Validasi quantity minimal 1
            if (newQuantity < 1) newQuantity = 1;

            // Update harga item terlebih dahulu (optimistic update)
            updateItemPrice(cartId, newQuantity);

            // Kirim permintaan AJAX untuk update quantity
            fetch(`/cart/${cartId}/update-quantity`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update harga total untuk item ini
                        prices[cartId] = data.new_price;
                        updateTotal();

                        // Jika ada perbedaan antara optimistic update dan response server
                        updateItemPrice(cartId, data.new_quantity || newQuantity);
                    } else {
                        alert('Gagal mengupdate quantity');
                        // Rollback jika gagal
                        const quantitySpan = document.querySelector(`.quantity-control[data-cart-id="${cartId}"] .quantity-span`);
                        if (quantitySpan) {
                            quantitySpan.textContent = data.old_quantity || (newQuantity - 1);
                            updateItemPrice(cartId, data.old_quantity || (newQuantity - 1));
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Rollback jika error
                    const quantitySpan = document.querySelector(`.quantity-control[data-cart-id="${cartId}"] .quantity-span`);
                    if (quantitySpan) {
                        const oldQuantity = parseInt(quantitySpan.textContent) - 1;
                        quantitySpan.textContent = oldQuantity;
                        updateItemPrice(cartId, oldQuantity);
                    }
                });
        }
        // Fungsi untuk menangani tombol +/-
        function setupQuantityControls() {
            document.querySelectorAll('.quantity-control').forEach(control => {
                const cartId = control.dataset.cartId;
                const minusBtn = control.querySelector('.minus-btn');
                const plusBtn = control.querySelector('.plus-btn');
                const quantitySpan = control.querySelector('.quantity-span');
                const quantityInput = control.querySelector('.quantity-input');

                // Tombol minus
                minusBtn.addEventListener('click', () => {
                    let currentQty = parseInt(quantitySpan.textContent);
                    if (currentQty > 1) {
                        currentQty--;
                        quantitySpan.textContent = currentQty;
                        updateQuantity(cartId, currentQty);
                    }
                });

                // Tombol plus
                plusBtn.addEventListener('click', () => {
                    let currentQty = parseInt(quantitySpan.textContent);
                    currentQty++;
                    quantitySpan.textContent = currentQty;
                    updateQuantity(cartId, currentQty);
                });

                // Input langsung (toggle span dengan input)
                quantitySpan.addEventListener('click', () => {
                    quantitySpan.style.display = 'none';
                    quantityInput.style.display = 'inline-block';
                    quantityInput.value = quantitySpan.textContent;
                    quantityInput.focus();
                });

                quantityInput.addEventListener('blur', () => {
                    let newQty = parseInt(quantityInput.value) || 1;
                    quantitySpan.textContent = newQty;
                    quantitySpan.style.display = 'inline-block';
                    quantityInput.style.display = 'none';
                    updateQuantity(cartId, newQty);
                });

                quantityInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        quantityInput.blur();
                    }
                });
            });
        }

        // Panggil fungsi setup saat halaman dimuat
        document.addEventListener('DOMContentLoaded', setupQuantityControls);
    </script>
    <!-- Script untuk total dan validasi -->
    <script>
        const checkboxes = document.querySelectorAll('.select-cart-item');
        const totalDisplay = document.getElementById('totalHarga');
        const checkoutForm = document.getElementById('checkout-form');
        const selectAllCheckbox = document.getElementById('select-all');

        const prices = @json($carts -> mapWithKeys(fn($c) => [$c -> id => $c -> product -> price * $c -> quantity]));

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += prices[cb.value];
                }
            });
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));

        // "Select All"
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
            updateTotal();
        });

        // Validasi sebelum submit
        checkoutForm.addEventListener('submit', function(e) {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (!anyChecked) {
                e.preventDefault();
                alert('Pilih minimal 1 item untuk checkout.');
            }
        });

        function submitDelete(cartId) {
            if (confirm('Yakin ingin menghapus item dari keranjang?')) {
                document.getElementById(`delete-form-${cartId}`).submit();
            }
        }
    </script>
</body>

</html>