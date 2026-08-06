<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    /**
     * Enforce admin check helper.
     */
    private function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
    }

    /**
     * Store a new blog category.
     */
    public function storeCategory(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $name = $request->name;
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        while (BlogCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        BlogCategory::create([
            'name' => $name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog Category created successfully!');
    }

    /**
     * Delete a blog category.
     */
    public function destroyCategory($id)
    {
        $this->checkAdmin();

        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog Category deleted successfully!');
    }

    /**
     * Store a new blog subcategory.
     */
    public function storeSubcategory(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'category_id' => ['required', 'exists:blog_categories,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $name = $request->name;
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        while (BlogSubcategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        BlogSubcategory::create([
            'category_id' => $request->category_id,
            'name' => $name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog Subcategory created successfully!');
    }

    /**
     * Delete a blog subcategory.
     */
    public function destroySubcategory($id)
    {
        $this->checkAdmin();

        $subcategory = BlogSubcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog Subcategory deleted successfully!');
    }

    /**
     * Store/publish a new blog post.
     */
    public function storeBlog(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:blog_categories,id'],
            'subcategory_id' => ['nullable', 'exists:blog_subcategories,id'],
            'preview_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'author' => ['nullable', 'string', 'max:100'],
        ]);

        $title = $request->title;
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('preview_image')) {
            try {
                $file = $request->file('preview_image');
                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                
                $uploadDirectory = public_path('uploads/blogs');
                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }

                $file->move($uploadDirectory, $filename);
                $imagePath = 'uploads/blogs/' . $filename;
            } catch (\Exception $e) {
                return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('error', 'Failed to upload preview image: ' . $e->getMessage());
            }
        }

        Blog::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title' => $title,
            'slug' => $slug,
            'content' => $request->content,
            'preview_image' => $imagePath,
            'author' => $request->author ?? 'WMP Admin'
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog post published successfully!');
    }

    /**
     * Delete a blog post.
     */
    public function destroyBlog($id)
    {
        $this->checkAdmin();

        $blog = Blog::findOrFail($id);
        
        // Optionally delete the associated image from storage
        if ($blog->preview_image && file_exists(public_path($blog->preview_image))) {
            @unlink(public_path($blog->preview_image));
        }

        $blog->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'blogs'])->with('success', 'Blog post deleted successfully!');
    }
}
