@props(['banner'])
<div x-show="showConfirmDelete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-80">
        <h2 class="text-lg font-semibold text-red-600 mb-4 text-center p-2 border-b-2">Konfirmasi Penghapusan</h2>
        <p class="mb-6">Yakin ingin menghapus banner ?</p>
        @if($banner->image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Image" class="w-full h-32 object-cover rounded">
        </div>
        @endif
        <div class="flex justify-end space-x-4">
            <form method="POST" action="{{ route('productroom.banner.delete', $banner->id) }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Ya, Hapus</button>
            </form>
            <button @click="showConfirmDelete = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 text-gray-800">
                Batal
            </button>
        </div>
    </div>
</div>