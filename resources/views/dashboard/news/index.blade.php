@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Daftar Berita</h1>
        <a href="{{ route('news.create') }}" 
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            + Tambah Berita
        </a>
    </div>

    <!-- Filter Section -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <form method="GET" action="{{ route('news.index') }}" class="flex flex-col sm:flex-row items-start sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="w-full sm:w-64">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter Kategori:
                </label>
                <select id="category" 
                        name="category" 
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->news->count() }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            @if(request('category'))
            <div class="flex items-end">
                <a href="{{ route('news.index') }}" 
                   class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-blue-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset Filter
                </a>
            </div>
            @endif
        </form>
    </div>

    @if($news->count() > 0)
    <!-- Statistics -->
    <div class="mb-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Berita</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $news->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Published</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\News::where('status', 'published')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Draft</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\News::where('status', 'draft')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Thumbnail</th>
                    <th scope="col" class="px-6 py-3">Judul</th>
                    <th scope="col" class="px-6 py-3">Kategori</th>
                    <th scope="col" class="px-6 py-3">Penulis</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" 
                             alt="{{ $item->judul }}" 
                             class="w-20 h-20 object-cover rounded-lg shadow-sm">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-xs">
                            <p class="font-semibold text-gray-900 truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($item->deskripsi, 60) }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ $item->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $item->penulis }}</td>
                    <td class="px-6 py-4">
                        @if($item->status == 'published')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Published
                        </span>
                        @else
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Draft
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('news.edit', $item) }}" 
                               class="font-medium text-blue-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('news.destroy', $item) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $news->appends(request()->query())->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan berita baru.</p>
        <div class="mt-6">
            <a href="{{ route('news.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                + Tambah Berita
            </a>
        </div>
    </div>
    @endif
</div>
@endsection