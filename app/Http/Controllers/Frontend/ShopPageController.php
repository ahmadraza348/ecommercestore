<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopPageController extends Controller
{

public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null)
{
    // Default values
    $sliderCategories = Category::where('status', 1)->whereNull('parent_id')->with('subcategories')->get(); // Parent categories shown in the slider by default
    $productsQuery = Product::query(); // Query to fetch all products by default
    $currentCategory = null; // Variable to hold the current category

    // Handle category navigation through slugs
    if ($slug) {
        $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();

        // Navigate through subcategories, child categories, and superchild categories if provided
        foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
            if ($currentCategory && $currentSlug) {
                $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();
            }
        }

        // If a specific category is found, update slider categories and products
        if ($currentCategory) {
            $sliderCategories = $currentCategory->subcategories; // Subcategories for the slider
            $productsQuery = $currentCategory->products(); // Products belonging to the current category
        }
    }

    // Retrieve products for the selected category or all products by default
    $products = $productsQuery->latest()->paginate(1);

    // Return data to the shop view
    return view('frontend.shop', [
        'sliderCategories' => $sliderCategories, // Categories to display in the slider
        'products' => $products,              // Paginated products for the shop page
        'currentCategory' => $currentCategory // Current category for breadcrumbs or title
    ]);
}

    
    }
    

