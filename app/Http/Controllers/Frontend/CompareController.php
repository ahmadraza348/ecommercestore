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

    public function remove(Request $request)
    {
        $compare = session()->get('compare', []);
        if(isset($compare[$request->product_id])) {
            unset($compare[$request->product_id]);
            session()->put('compare', $compare);
        }

        return response()->json([
            'status' => 'success', 
            'message' => 'Product removed from comparison',
            'compare_count' => count($compare)
        ]);
    }
}