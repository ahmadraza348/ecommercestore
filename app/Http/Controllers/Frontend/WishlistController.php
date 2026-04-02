<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

// App/Http/Controllers/Frontend/WishlistController.php

public function index() 
{
    $wishlistSession = session()->get('wishlist', []);
    $productIds = array_keys($wishlistSession);
    
    // Fetch products from DB that are in the session
    $products = \App\Models\Product::whereIn('id', $productIds)->with('gallery_images')->get();

    return view('frontend.wishlist', compact('products'));
}

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$productId])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product already in wishlist'
            ]);
        }

        // Add to session
        $wishlist[$productId] = [
            "id" => $productId,
            "added_at" => now()
        ];

        session()->put('wishlist', $wishlist);

        return response()->json([
            'status' => 'success',
            'message' => 'Added to wishlist!',
            'wishlist_count' => count($wishlist)
        ]);
    }

    public function getCount()
    {
        return response()->json(['count' => count(session()->get('wishlist', []))]);
    }
    public function remove(Request $request )
    {
        $productId = $request->product_id;
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            session()->put('wishlist', $wishlist);

            return response()->json([
                'status' => 'success',
                'message' => 'Removed from wishlist',
                'wishlist_count' => count($wishlist)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Product not found in wishlist'
        ]);
    }
}