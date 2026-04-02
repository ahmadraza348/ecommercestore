<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CompareController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $compare = session()->get('compare', []);

        if (count($compare) >= 4) {
            return response()->json([
                'status' => 'error',
                'message' => 'You can only compare up to 4 products.'
            ]);
        }

        if (isset($compare[$productId])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product already in compare list'
            ]);
        }

        $compare[$productId] = ["id" => $productId];
        session()->put('compare', $compare);

        return response()->json([
            'status' => 'success',
            'message' => 'Added to comparison list!',
            'compare_count' => count($compare)
        ]);
    }

    public function index()
    {
        $compareSession = session()->get('compare', []);
        $productIds = array_keys($compareSession);
        
        // Fetch up to 3 products
        $products = Product::whereIn('id', $productIds)
            ->with(['gallery_images', 'categories', 'attributes'])
            ->limit(3)
            ->get();

        return view('frontend.compare', compact('products'));
    }

  public function remove(Request $request, $id) // Added $id here
{
    // 1. Fetch the current wishlist from session
    $compare = session()->get('compare', []);

    // 2. Check if the ID (passed from URL) exists in the session keys
    if (isset($compare[$id])) {
        unset($compare[$id]);
        
        // 3. Update the session
        session()->put('compare', $compare);

        return redirect()->back()->with('success', 'Item removed from compare!');
    }

    return redirect()->back()->with('error', 'Item not found in compare.');
}
}