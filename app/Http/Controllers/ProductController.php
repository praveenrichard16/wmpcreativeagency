<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Enforce Admin Role Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'preview_image' => ['nullable', 'image', 'max:2048'], // 2MB max
            'download_file' => ['nullable', 'file', 'max:10240'], // 10MB max
        ]);

        // Process Preview Image
        $previewImagePath = null;
        if ($request->hasFile('preview_image')) {
            $file = $request->file('preview_image');
            $fileName = 'preview_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $fileName);
            $previewImagePath = 'images/' . $fileName;
        }

        // Process Download File
        $downloadFilePath = null;
        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $fileName = 'asset_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('downloads'), $fileName);
            $downloadFilePath = 'downloads/' . $fileName;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'preview_image' => $previewImagePath ?? 'images/logo.png', // Fallback to logo if no image
            'download_file' => $downloadFilePath ?? 'downloads/mock_asset.zip',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Digital product added successfully!');
    }
}
