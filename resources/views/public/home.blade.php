@extends('layouts.public')

@section('title', 'Beranda')
@section('description', 'Portal berita terpercaya dengan informasi terkini dari berbagai kategori. Dapatkan berita terupdate setiap hari.')

@section('content')
<!-- Hero Section -->
@if($featuredNews)
<section class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 text-white overflow-hidden">
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                    Breaking News
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold leading-tight">
                    {{ $featuredNews->judul }}
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed">
                    {{ Str::limit($featuredNews->deskripsi, 150) }}
                </p>
                <div class="flex items-center space-x-4 text-sm text-gray-200">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        {{ $featuredNews->category->nama_kategori }}
                    </span>
                    <span>•</span>
                    <span>{{ $featuredNews->penulis }}</span>
                    <span>•</span>
                    <span>{{ $featuredNews->created_at->diffForHumans() }}</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('news.show', $featuredNews->slug) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Baca Selengkapnya
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative">
                @if($featuredNews->thumbnail)
                <div class="relative overflow-hidden rounded-2xl shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ Storage::url($featuredNews->thumbnail) }}" 
                         alt="{{ $featuredNews->judul }}" 
                         class="w-full h-80 lg:h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Categories Section -->
@if($categories->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Jelajahi Kategori</h2>
            <p class="text-xl text-gray-600">Temukan berita berdasarkan minat Anda</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('category', $category->slug) }}" 
               class="group bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 text-center hover:from-blue-100 hover:to-purple-100 transition-all duration-300 transform hover:scale-105 card-hover">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white font-bold text-lg group-hover:shadow-lg transition-shadow duration-300">
                    {{ substr($category->nama_kategori, 0, 1) }}
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">{{ $category->nama_kategori }}</h3>
                <p class="text-sm text-gray-600">{{ $category->news_count }} berita</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest News Section -->
@if($latestNews->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-xl text-gray-600">Update terkini yang perlu Anda ketahui</p>
            </div>
            <a href="{{ route('search') }}" class="hidden sm:inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-colors duration-300">
                Lihat Semua
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestNews as $news)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                @if($news->thumbnail)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ Storage::url($news->thumbnail) }}" 
                         alt="{{ $news->judul }}" 
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $news->category->id % 2 == 0 ? 'blue' : 'purple' }}-600 text-white">
                            {{ $news->category->nama_kategori }}
                        </span>
                    </div>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span>{{ $news->penulis }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $news->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors duration-300">
                        <a href="{{ route('news.show', $news->slug) }}">{{ $news->judul }}</a>
                    </h3>
                    
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        {{ Str::limit($news->deskripsi, 120) }}
                    </p>
                    
                    <a href="{{ route('news.show', $news->slug) }}" 
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
    </div>
</section>
@endif

<!-- Trending Section -->
@if($trendingNews->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Sedang Trending</h2>
            <p class="text-xl text-gray-600">Berita yang paling banyak dibaca hari ini</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($trendingNews as $index => $news)
            <article class="flex bg-gray-50 rounded-2xl overflow-hidden card-hover">
                <div class="flex-shrink-0 w-24 bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                    <span class="text-2xl font-bold text-white">{{ $index + 1 }}</span>
                </div>
                
                @if($news->thumbnail)
                <div class="flex-shrink-0 w-32 h-32">
                    <img src="{{ Storage::url($news->thumbnail) }}" 
                         alt="{{ $news->judul }}" 
                         class="w-full h-full object-cover">
                </div>
                @endif
                
                <div class="flex-1 p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $news->category->id % 2 == 0 ? 'blue' : 'purple' }}-100 text-{{ $news->category->id % 2 == 0 ? 'blue' : 'purple' }}-800 mr-2">
                            {{ $news->category->nama_kategori }}
                        </span>
                        <span>{{ $news->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors duration-300">
                        <a href="{{ route('news.show', $news->slug) }}">{{ Str::limit($news->judul, 80) }}</a>
                    </h3>
                    
                    <p class="text-gray-600 text-sm">
                        {{ Str::limit($news->deskripsi, 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Dapatkan Berita Terbaru</h2>
        <p class="text-xl text-blue-100 mb-8">Berlangganan newsletter kami dan jangan lewatkan berita penting</p>
        
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Masukkan email Anda" 
                   class="flex-1 px-6 py-3 rounded-full border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50 text-gray-900 placeholder-gray-500">
            <button type="submit" 
                    class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition-colors duration-300 transform hover:scale-105">
                Berlangganan
            </button>
        </form>
    </div>
</section>
@endsection