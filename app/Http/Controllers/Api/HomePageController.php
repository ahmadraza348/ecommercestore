<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class HomePageController extends Controller
{
  public function fetch_categories(){
    try {
        $categories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->with('subcategories')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error fetching categories: ' . $e->getMessage()
        ], 500);
    }
}
}
