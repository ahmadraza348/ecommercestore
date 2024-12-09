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
        // Fetch all parent categories for the default slider
        $categories = Category::where('status', 1)->whereNull('parent_id')->with('subcategories')->get();
    
        // Default: Show parent categories in slider and all latest products
        $sliderCategories = $categories;
        $productsQuery = Product::query();
    
        $currentCategory = null;
    
        if ($slug) {
            // Fetch the current parent category
            $currentCategory = Category::where('slug', $slug)->with('subcategories')->first();
    
            if ($currentCategory && $subslug) {
                // Fetch the subcategory
                $currentCategory = $currentCategory->subcategories->where('slug', $subslug)->first();
    
                if ($currentCategory && $childslug) {
                    // Fetch the child category
                    $currentCategory = $currentCategory->subcategories->where('slug', $childslug)->first();
    
                    if ($currentCategory && $superchildslug) {
                        // Fetch the superchild category
                        $currentCategory = $currentCategory->subcategories->where('slug', $superchildslug)->first();
                    }
                }
            }
    
            if ($currentCategory) {
                // If a specific category is found, set subcategories for the slider
                $sliderCategories = $currentCategory->subcategories;
    
                // Fetch products related to this category
                $productsQuery = $currentCategory->products();
            }
        }
    
        // Retrieve the products for the current category or default
        $products = $productsQuery->latest()->paginate(12);
    
        // Return to the view
        return view('frontend.shop', [
            'categories' => $categories, // Parent categories for the navbar
            'sliderCategories' => $sliderCategories, // Categories to display in the slider
            'products' => $products, // Products to display on the shop page
            'currentCategory' => $currentCategory, // Current category for breadcrumb or title
        ]);
    }
    
    
    
    }
    

