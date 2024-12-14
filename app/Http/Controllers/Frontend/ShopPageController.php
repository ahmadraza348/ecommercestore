<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class ShopPageController extends Controller
{

public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null, $brandSlug = null)
{
    // Default values for Shop Page
    $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
    $shopPageBrands = Brand::where('status', 1)->get();
    $productsQuery = Product::query();
    $currentCategory = null;
    $currentBrand = null;

    if ($slug) {
        // parent category shop page
        $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();

        // If the current category is found, navigate through subcategories
        foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
            if ($currentCategory && $currentSlug) {
                $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();
            }
        }

        // If a specific category is found, update categories, products, and brands
        if ($currentCategory) {
            $shopPageCategories = $currentCategory->subcategories;
            $productsQuery = $currentCategory->products();

            // Fetch brands associated with the current category
            $shopPageBrands = Brand::whereHas('categories', function ($query) use ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            })->get();
        }
    }

    // Handle brand slug for Brand Page
    if ($brandSlug) {
        $currentBrand = Brand::with('categories')->where('slug', $brandSlug)->first();

        if ($currentBrand) {
            // Fetch products and categories associated with the brand
            $productsQuery = Product::where('brand_id', $currentBrand->id);
            $shopPageCategories = $currentBrand->categories;
        }
    }

    // Retrieve paginated products
    $products = $productsQuery->latest()->paginate(12);

    // Return data to the shop view
    return view('frontend.shop', [
        'shopPageCategories' => $shopPageCategories, // Categories to display in the slider
        'products' => $products,                    // Paginated products
        'currentCategory' => $currentCategory,      // Current category for breadcrumbs
        'shopPageBrands' => $shopPageBrands,        // Brands related to the category
        'currentBrand' => $currentBrand             // Current brand for the brand page
    ]);
}
    
    }
    

