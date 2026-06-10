<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBlogs      = Blog::count();
        $totalCategories = Category::count();
        $recentBlogs     = Blog::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBlogs', 'totalCategories', 'recentBlogs'));
    }
}
