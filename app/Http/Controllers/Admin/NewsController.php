<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::with('category');
        
        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        $news = $query->latest()->paginate(10);
        $categories = Category::all();
        
        return view('dashboard.news.index', compact('news', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'penulis' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        News::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'penulis' => $request->penulis,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        // Not implemented
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('dashboard.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|exists:categories,id',
            'penulis' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = $news->thumbnail;
        
        // Handle new thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $news->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'penulis' => $request->penulis,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }
        
        $news->delete();
        
        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
