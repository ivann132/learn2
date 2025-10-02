@extends('layouts.public')

@section('title', 'Pencarian: ' . ($query ?? 'Semua Berita'))

@section('content')
<!-- Search Header -->
<section class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            @if($query)
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                Hasil pencarian untuk "{{ $query }}"
            </h1>
            <p class="text-xl text-gray-600">{{ $news->total() }} berita ditemukan</p>
            @else
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Semua Berita</h1>
            <p class="text-xl text-gray-600">{{ $news->total() }} berita tersedia</p>
            @endif
        </div>

        <!-- Search Form -->
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" value="{{ $query }}" 
                       placeholder="Cari berita..." 
                       class="w-full pl-12 pr-16 py-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <span class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition-colors duration-300">
                        Cari
                    </span>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                @if($item->thumbnail)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ Storage::url($item->thumbnail) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-600 text-white">
                            {{ $item->category->name }}
                        </span>
                    </div>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span>{{ $item->penulis }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors duration-300">
                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->judul }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        {{ Str::limit($item->deskripsi, 120) }}
                    </p>
                    <a href="{{ route('news.show', $item->slug) }}"
                          class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition-colors duration-300">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-12">
            {{ $news->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada berita ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba kata kunci lain atau periksa ejaan Anda.</p>
        </div>
        @endif
    </div>
</section>
@endsection