@extends('layouts.public')

@section('title', $category->nama_kategori)
@section('description', 'Berita terbaru dalam kategori ' . $category->nama_kategori)

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $category->nama_kategori }}</h1>
            <p class="text-xl text-blue-100">{{ $news->total() }} berita ditemukan</p>
        </div>
    </div>
</section>

<!-- News Grid -->
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
                    <div class="absolute top-4 right-4">
                        <span class="bg-white bg-opacity-90 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $item->created_at->diffForHumans() }}
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
            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Belum ada berita</h3>
            <p class="text-gray-600">Kategori ini belum memiliki berita yang dipublikasikan.</p>
        </div>
        @endif
    </div>
</section>
@endsection