@props(['banner'])
<div x-show="editPost" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-80">
        <div class="flex justify-end">
            <button @click="editPost = false" class="text-gray-500 hover:text-red-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('productroom.banner.update', $banner->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <h3 class="text-xl text-center font-bold text-amber-400">Edit Postingan</h3>
            <div class="flex flex-col flex-grow mb-3">
                <div
                    x-data="{ thumbnails: [], removeThumbnail(index) { this.thumbnails.splice(index, 1); } }"
                    class="block w-full py-2 px-3 bg-white border-2 border-gray-300 rounded-md relative">

                    @if($banner->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Image" class="w-full h-32 object-cover rounded">
                    </div>
                    @endif

                    <input name="image"
                        type="file" accept="image/*"
                        class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                        @change="thumbnails = Array.from($event.target.files)">

                    <template x-if="thumbnails.length > 0">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <template x-for="(file, index) in thumbnails" :key="index">
                                <div class="relative group border rounded p-2">
                                    <img :src="URL.createObjectURL(file)" class="w-full h-32 object-cover rounded">
                                    <button type="button"
                                        @click="removeThumbnail(index)"
                                        class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full p-1 opacity-80 hover:opacity-100">
                                        &times;
                                    </button>
                                    <p class="text-xs mt-1 truncate" x-text="file.name"></p>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="thumbnails.length === 0">
                        <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600">
                            <i class="fas fa-image fa-3x mb-2"></i>
                            <p>Drag dan drop atau klik untuk unggah gambar thumbnail</p>
                        </div>
                    </template>
                </div>
            </div>

            <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white py-2 rounded-lg">
                Edit
            </button>
        </form>
    </div>
</div>