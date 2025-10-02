<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Featured news (latest published)
        $featuredNews = News::with('category')
            ->where('status', 'published')
            ->latest()
            ->first();

        // Latest news excluding featured
        $latestNews = News::with('category')
            ->where('status', 'published')
            ->when($featuredNews, function($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->latest()
            ->take(6)
            ->get();

        // Popular categories with news count
        $categories = Category::withCount(['news' => function($query) {
            $query->where('status', 'published');
        }])
        ->having('news_count', '>', 0)
        ->orderBy('news_count', 'desc')
        ->take(6)
        ->get();

        // Trending news
        $trendingNews = News::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get();

        return view('public.home', compact(
            'featuredNews', 
            'latestNews', 
            'categories', 
            'trendingNews'
        ));
    }

    public function category(Category $category, Request $request)
    {
        $news = News::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('public.category', compact('category', 'news'));
    }

    public function show(News $news)
    {
        // Only show published news
        if ($news->status !== 'published') {
            abort(404);
        }

        // Related news from same category
        $relatedNews = News::with('category')
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get();

        // Latest news for sidebar
        $latestNews = News::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();

        return view('public.news-detail', compact('news', 'relatedNews', 'latestNews'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $news = News::with('category')
            ->where('status', 'published')
            ->when($query, function($queryBuilder) use ($query) {
                return $queryBuilder->where('judul', 'like', "%{$query}%")
                                  ->orWhere('deskripsi', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        return view('public.search', compact('news', 'query'));
    }
}
