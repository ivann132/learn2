@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('categories.index') }}" 
           class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Kategori Baru</h1>
    </div>

    <form action="{{ route('categories.store') }}" method="POST" class="max-w-2xl">
        @csrf
        
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror" 
                   placeholder="Contoh: Teknologi, Olahraga, Politik"
                   required
                   autofocus>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-sm text-gray-500">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Slug akan dibuat otomatis dari nama kategori
            </p>
        </div>

        <div class="flex space-x-4">
            <button type="submit" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Kategori
            </button>
            <a href="{{ route('categories.index') }}" 
               class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection