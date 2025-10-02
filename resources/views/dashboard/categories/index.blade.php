@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" 
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            + Tambah Kategori
        </a>
    </div>

    @if($categories->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nama Kategori</th>
                    <th scope="col" class="px-6 py-3">Slug</th>
                    <th scope="col" class="px-6 py-3">Jumlah Berita</th>
                    <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $category->id }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ $category->news->count() }} berita
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $category->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('categories.edit', $category) }}" 
                               class="font-medium text-blue-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua berita dalam kategori ini juga akan terhapus!')">
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
        {{ $categories->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kategori</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kategori baru.</p>
        <div class="mt-6">
            <a href="{{ route('categories.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                + Tambah Kategori
            </a>
        </div>
    </div>
    @endif
</div>
@endsection