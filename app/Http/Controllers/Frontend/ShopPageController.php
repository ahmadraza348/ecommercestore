<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Brand;

class ShopPageController extends Controller
{
public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null)
{
    // Default values for Shop Page
    $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
    $shopPageBrands = Brand::where('status', 1)->get();
    $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
    $productsQuery = Product::query();

    // Initialize variables for the current category, brand, and attributes
    $currentCategory = null;
    $currentBrand = null;

    // Check if a category slug is provided
    if ($slug) {
        // Fetch the current category and related subcategories
        $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
        // Fetch attributes linked to the current category
        if ($currentCategory) {
            $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            })->with('attributevalue')->get();
        }

        // Check if the slug corresponds to a brand
        $currentBrand = Brand::with('categories')->where('slug', $slug)->first();
        if ($currentBrand) {
            $productsQuery = Product::where('brand_id', $currentBrand->id);
            $shopPageCategories = $currentBrand->categories;
        }

        // Process subcategory slugs (subslug, childslug, superchildslug)
        foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
            if ($currentCategory && $currentSlug) {
                $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();

                if ($currentCategory) {
                    // Update attributes for the current subcategory
                    $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                        $query->where('category_id', $currentCategory->id);
                    })->with('attributevalue')->get();
                }
            }
        }

        // If a specific category is found, update related data
        if ($currentCategory) {
            $shopPageCategories = $currentCategory->subcategories;
            $productsQuery = $currentCategory->products();
            $shopPageBrands = Brand::whereHas('categories', function ($query) use ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            })->get();
        }
    }

    // Fetch paginated products
    $products = $productsQuery->latest()->paginate(12);

    // Return the shop page view with relevant data
    return view('frontend.shop', [
        'shopPageCategories' => $shopPageCategories,
        'products' => $products,
        'currentCategory' => $currentCategory,
        'shopPageBrands' => $shopPageBrands,
        'currentBrand' => $currentBrand,
        'shopPageAttributes' => $shopPageAttributes,
    ]);
}
public function filterProductsByBrands(Request $request)
{
    // Retrieve filter inputs from the request
    $brandIds = $request->input('brand_ids', []);
    $attributeValues = $request->input('attribute_values', []);
    $currentSlug = $request->input('current_slug', '');

    // Initialize the query
    $products = Product::query();

    // Filter by current slug (category or brand)
    if (!empty($currentSlug)) {
        // Check if the slug belongs to a category
        $currentCategory = Category::where('slug', $currentSlug)->first();
        if ($currentCategory) {
            $products->whereHas('categories', function ($query) use ($currentCategory) {
                $query->where('categories.id', $currentCategory->id); // Explicitly qualify 'id'
            });
        }

        // Check if the slug belongs to a brand
        $currentBrand = Brand::where('slug', $currentSlug)->first();
        if ($currentBrand) {
            $products->where('brand_id', $currentBrand->id);
        }
    }

    // Apply brand filter (AND logic)
    if (!empty($brandIds)) {
        $products->whereIn('brand_id', $brandIds);
    }

    // Apply attribute values filter (AND logic)
    if (!empty($attributeValues)) {
        foreach ($attributeValues as $attributeValueId) {
            $products->whereHas('attributes', function ($query) use ($attributeValueId) {
                $query->where('attribute_value_id', $attributeValueId);
            });
        }
    }

    // Fetch filtered products
    $products = $products->latest()->paginate(12);

    // Return filtered products as JSON
    return response()->json([
        'html' => view('frontend.partials.pro_slide_list', ['products' => $products])->render()
    ]);
}


}
