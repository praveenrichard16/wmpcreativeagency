<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        // Enforce Admin Role Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $products = Product::orderBy('created_at', 'desc')->get();
        $tickets = SupportTicket::with(['user.purchasedProducts', 'messages.user'])->orderBy('created_at', 'desc')->get();
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        $transactions = Purchase::with(['user', 'product'])->orderBy('created_at', 'desc')->get();
        
        $blogCategories = \App\Models\BlogCategory::with('subcategories')->orderBy('name', 'asc')->get();
        $blogSubcategories = \App\Models\BlogSubcategory::with('category')->orderBy('name', 'asc')->get();
        $blogs = \App\Models\Blog::with(['category', 'subcategory'])->orderBy('created_at', 'desc')->get();

        $totalSales = Purchase::sum('price_paid');
        $totalTicketsCount = SupportTicket::count();
        $openTicketsCount = SupportTicket::where('status', 'open')->count();
        $totalProductsCount = Product::count();
        $totalUsersCount = \App\Models\User::count();

        return view('admin.dashboard', compact(
            'products', 
            'tickets', 
            'users',
            'transactions',
            'totalSales', 
            'totalTicketsCount', 
            'openTicketsCount', 
            'totalProductsCount',
            'totalUsersCount',
            'blogCategories',
            'blogSubcategories',
            'blogs'
        ));
    }

    /**
     * Update system settings (specifically, the platform logo).
     */
    public function updateSettings(Request $request)
    {
        // Enforce Admin Role Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            try {
                $file = $request->file('logo');
                
                // Ensure the public/images directory exists
                $imagesPath = public_path('images');
                if (!file_exists($imagesPath)) {
                    mkdir($imagesPath, 0755, true);
                }

                // Overwrite the existing logo.png
                $file->move($imagesPath, 'logo.png');
                
                return redirect()->route('admin.dashboard', ['tab' => 'settings'])->with('success', 'Logo uploaded and updated successfully!');
            } catch (\Exception $e) {
                return redirect()->route('admin.dashboard', ['tab' => 'settings'])->with('error', 'Failed to update logo: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.dashboard', ['tab' => 'settings'])->with('error', 'No logo file was uploaded.');
    }
}
