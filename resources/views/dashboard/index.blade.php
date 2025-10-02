@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">
        Selamat Datang, {{ Auth::user()->name }}! 👋
    </h1>
    <p class="text-gray-600">Berikut adalah ringkasan sistem manajemen berita Anda.</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Berita -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Total Berita</p>
                <h3 class="text-3xl font-bold">{{ \App\Models\News::count() }}</h3>
                <p class="text-blue-100 text-xs mt-2">
                    +{{ \App\Models\News::whereDate('created_at', today())->count() }} hari ini
                </p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Berita Published -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Published</p>
                <h3 class="text-3xl font-bold">{{ \App\Models\News::where('status', 'published')->count() }}</h3>
                <p class="text-green-100 text-xs mt-2">
                    {{ number_format((\App\Models\News::where('status', 'published')->count() / max(\App\Models\News::count(), 1)) * 100, 1) }}% dari total
                </p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Berita Draft -->
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm font-medium mb-1">Draft</p>
                <h3 class="text-3xl font-bold">{{ \App\Models\News::where('status', 'draft')->count() }}</h3>
                <p class="text-yellow-100 text-xs mt-2">Menunggu publikasi</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium mb-1">Kategori</p>
                <h3 class="text-3xl font-bold">{{ \App\Models\Category::count() }}</h3>
                <p class="text-purple-100 text-xs mt-2">Total kategori aktif</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('news.create') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Tambah Berita Baru</h3>
                <p class="text-sm text-gray-600">Buat artikel baru</p>
            </div>
        </div>
    </a>

    <a href="{{ route('categories.create') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-purple-500">
        <div class="flex items-center">
            <div class="bg-purple-100 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Tambah Kategori</h3>
                <p class="text-sm text-gray-600">Buat kategori baru</p>
            </div>
        </div>
    </a>

    <a href="{{ route('home') }}" target="_blank" class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Lihat Website</h3>
                <p class="text-sm text-gray-600">Buka halaman publik</p>
            </div>
        </div>
    </a>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Berita Terbaru -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Berita Terbaru
                </h2>
            </div>
            
            <div class="p-6">
                @php
                    $latestNews = \App\Models\News::with('category')->latest()->take(5)->get();
                @endphp

                @if($latestNews->count() > 0)
                <div class="space-y-4">
                    @foreach($latestNews as $news)
                    <div class="flex items-start space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        @if($news->thumbnail)
                        <img src="{{ Storage::url($news->thumbnail) }}" 
                             alt="{{ $news->judul }}" 
                             class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                                <a href="{{ route('news.edit', $news) }}" class="hover:text-blue-600">
                                    {{ $news->judul }}
                                </a>
                            </h3>
                            <div class="flex items-center space-x-2 text-sm">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($news->status) }}
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $news->category->name }}
                                </span>
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-600">{{ $news->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $news->penulis }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('news.index') }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua Berita
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="mt-2 text-gray-600">Belum ada berita</p>
                    <a href="{{ route('news.create') }}" 
                       class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Berita Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Kategori Populer -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kategori Populer
                </h2>
            </div>
            
            <div class="p-6">
                @php
                    $popularCategories = \App\Models\Category::withCount('news')->orderBy('news_count', 'desc')->take(5)->get();
                @endphp

                @if($popularCategories->count() > 0)
                <div class="space-y-3">
                    @foreach($popularCategories as $category)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                            <div>
                                <a href="{{ route('categories.edit', $category) }}" 
                                   class="font-medium text-gray-900 hover:text-purple-600">
                                    {{ $category->name }}
                                </a>
                                <p class="text-xs text-gray-500">{{ $category->news_count }} berita</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-purple-600">{{ $category->news_count }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('categories.index') }}" 
                       class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium">
                        Kelola Kategori
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @else
                <div class="text-center py-6">
                    <p class="text-gray-600">Belum ada kategori</p>
                    <a href="{{ route('categories.create') }}" 
                       class="mt-3 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">
                        Tambah Kategori
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Activity Summary -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Aktivitas
                </h2>
            </div>
            
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Berita Hari Ini</span>
                    <span class="font-bold text-gray-900">{{ \App\Models\News::whereDate('created_at', today())->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Berita Minggu Ini</span>
                    <span class="font-bold text-gray-900">{{ \App\Models\News::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Berita Bulan Ini</span>
                    <span class="font-bold text-gray-900">{{ \App\Models\News::whereMonth('created_at', now()->month)->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection