<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
