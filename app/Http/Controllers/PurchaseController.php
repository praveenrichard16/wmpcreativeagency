<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Handle simulated product purchase checkout.
     */
    public function purchase(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('success', 'Please log in to purchase products.');
        }

        $userId = Auth::id();

        // Check if already purchased
        $existing = Purchase::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return redirect()->route('dashboard')->with('success', 'You already own "' . $product->name . '". Check your library below!');
        }

        Purchase::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'price_paid' => $product->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Thank you! "' . $product->name . '" has been added to your library.');
    }
}
