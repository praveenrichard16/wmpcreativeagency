<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSubcategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'subcategory'])->orderBy('created_at', 'desc');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->get();
        $categories = BlogCategory::with('subcategories')->get();
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();

        return view('blogs.index', compact('blogs', 'categories', 'recentBlogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'subcategory'])->where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::with('subcategories')->get();
        $recentBlogs = Blog::where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->take(5)->get();

        return view('blogs.show', compact('blog', 'categories', 'recentBlogs'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $blogs = Blog::with(['category', 'subcategory'])
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $categories = BlogCategory::with('subcategories')->get();
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $activeCategory = $category;

        return view('blogs.index', compact('blogs', 'categories', 'recentBlogs', 'activeCategory'));
    }

    public function subcategory($slug)
    {
        $subcategory = BlogSubcategory::with('category')->where('slug', $slug)->firstOrFail();
        $blogs = Blog::with(['category', 'subcategory'])
            ->where('subcategory_id', $subcategory->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $categories = BlogCategory::with('subcategories')->get();
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $activeSubcategory = $subcategory;

        return view('blogs.index', compact('blogs', 'categories', 'recentBlogs', 'activeSubcategory'));
    }
}
