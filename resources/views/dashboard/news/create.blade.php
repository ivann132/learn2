@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('news.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Berita Baru</h1>
    </div>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Judul -->
            <div class="md:col-span-2">
                <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="judul" 
                       name="judul" 
                       value="{{ old('judul') }}" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('judul') border-red-500 @enderror" 
                       placeholder="Masukkan judul berita yang menarik"
                       required>
                @error('judul')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select id="category_id" 
                        name="category_id" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('category_id') border-red-500 @enderror" 
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis -->
            <div>
                <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900">
                    Penulis <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="penulis" 
                       name="penulis" 
                       value="{{ old('penulis', Auth::user()->name) }}" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('penulis') border-red-500 @enderror" 
                       placeholder="Nama penulis"
                       required>
                @error('penulis')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('status') border-red-500 @enderror" 
                        required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div>
                <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900">
                    Thumbnail
                </label>
                <input type="file" 
                       id="thumbnail" 
                       name="thumbnail" 
                       accept="image/*"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('thumbnail') border-red-500 @enderror"
                       onchange="previewImage(event)">
                <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
                @error('thumbnail')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div id="imagePreview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg">
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">
                Deskripsi Singkat <span class="text-red-500">*</span>
            </label>
            <textarea id="deskripsi" 
                      name="deskripsi" 
                      rows="3" 
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('deskripsi') border-red-500 @enderror" 
                      placeholder="Ringkasan berita dalam 1-2 kalimat"
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">
                Konten Berita <span class="text-red-500">*</span>
            </label>
            <textarea id="content" 
                      name="content" 
                      rows="12" 
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('content') border-red-500 @enderror" 
                      placeholder="Tulis konten berita lengkap di sini..."
                      required>{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="submit" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Berita
            </button>
            <a href="{{ route('news.index') }}" 
               class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection