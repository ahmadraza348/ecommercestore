<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class HomePageController extends Controller
{
    // Fetch featured categories
    public function fetch_featured_categories()
    {
        try {
            $categories =Category::where('status', 1)
            ->whereNull('parent_id')
            ->with(['subcategories'])
                ->take(6)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Featured categories retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured categories: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fetch featured products
    public function fetch_featured_products()
    {
        try {
            $products = Product::where(['status' => 1, 'is_featured' => 1])
                ->take(8)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Featured products retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured products: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fetch hot deals
    public function fetch_hot_deals()
    {
        try {
            $products = Product::where(['status' => 1, 'label' => 'hot'])
                ->take(6)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Hot deals retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching hot deals: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fetch sale products
    public function fetch_sale_products()
    {
        try {
            $products = Product::where(['status' => 1, 'label' => 'sale'])
                ->take(6)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Sale products retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sale products: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fetch new arrival products
    public function fetch_new_arrivals()
    {
        try {
            $products = Product::where(['status' => 1, 'label' => 'new'])
                ->take(6)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'New arrivals retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching new arrivals: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fetch brands
    public function fetch_brands()
    {
        try {
            $brands = Brand::where('status', 1)
                ->take(8)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Brands retrieved successfully',
                'data' => $brands
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching brands: ' . $e->getMessage()
            ], 500);
        }
    }
}
