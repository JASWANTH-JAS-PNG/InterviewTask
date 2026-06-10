<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('blogs')->get();
        $query = Blog::with('category')->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) => $q->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%"));
        }

        $blogs = $query->paginate(9);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('blogs.partials.blog-cards', compact('blogs'))->render(),
                'pagination' => $blogs->links()->toHtml(),
            ]);
        }

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();
        $related = Blog::with('category')
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'related'));
    }
}
