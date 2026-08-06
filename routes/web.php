<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminBlogController;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Storefront (loads products dynamically)
Route::get('/', function () {
    $products = Product::orderBy('created_at', 'desc')->get();
    return view('welcome', compact('products'));
})->name('storefront');

// Services Dynamic Pages
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');

// About Us Page
Route::get('/about', [PageController::class, 'about'])->name('about');

// Public Blogs routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/category/{slug}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('/blogs/subcategory/{slug}', [BlogController::class, 'subcategory'])->name('blogs.subcategory');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// Auto-deployment Webhook Route
Route::match(['get', 'post'], '/deploy-hook', [\App\Http\Controllers\DeploymentController::class, 'deploy']);

// Guest-Only Routes (login, registration)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes (for all logged-in users)
Route::middleware('auth')->group(function () {
    
    // Log Out
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // User Customer Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        // If an admin accesses /dashboard, redirect them to their specialized panel
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Fetch purchased files and ticket history
        $purchases = Purchase::with('product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $tickets = SupportTicket::with('messages.user')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('purchases', 'tickets'));
    })->name('dashboard');

    // Submit Support Ticket
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

    // Append Message to Thread (Shared by User and Admin)
    Route::post('/tickets/{ticket}/messages', [TicketController::class, 'storeMessage'])->name('tickets.messages.store');

    // Purchase Product Checkout Simulation
    Route::post('/purchase/{product}', [PurchaseController::class, 'purchase'])->name('purchase.store');

    // ==========================================
    // Admin Only Routes
    // ==========================================
    Route::prefix('admin')->group(function () {
        
        // Admin Panel Index
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Add new digital product
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        
        // Save Admin internal note
        Route::post('/tickets/{ticket}/note', [TicketController::class, 'updateNote'])->name('admin.tickets.note');

        // Update System Settings (Logo)
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

        // Blogs, Categories, and Subcategories Management
        Route::post('/blogs/categories', [AdminBlogController::class, 'storeCategory'])->name('admin.blogs.categories.store');
        Route::delete('/blogs/categories/{id}', [AdminBlogController::class, 'destroyCategory'])->name('admin.blogs.categories.destroy');
        
        Route::post('/blogs/subcategories', [AdminBlogController::class, 'storeSubcategory'])->name('admin.blogs.subcategories.store');
        Route::delete('/blogs/subcategories/{id}', [AdminBlogController::class, 'destroySubcategory'])->name('admin.blogs.subcategories.destroy');
        
        Route::post('/blogs', [AdminBlogController::class, 'storeBlog'])->name('admin.blogs.store');
        Route::delete('/blogs/{id}', [AdminBlogController::class, 'destroyBlog'])->name('admin.blogs.destroy');
    });
});
