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
    public function index(Request $request, $slug = null, $subslug = null, $childslug = null, $superchildslug = null)
    {
        // For URL = https://domainname/shop
        // Sending data for the shop page
        $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
        $shopPageBrands = Brand::where('status', 1)->get();
        $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
        $productsQuery = Product::query();
        $currentCategory = null;
        $currentBrand = null;

        $min_price_filter = $request->input('min_price', 0);
        $max_price_filter = $request->input('max_price', PHP_INT_MAX);

        if ($slug) {
            // For parent category's shop page
            $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
            if ($currentCategory) {
                $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                    $query->where('category_id', $currentCategory->id);
                })->with('attributevalue')->get();
            }

            // For nested categories inside parent category
            foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
                if ($currentCategory && $currentSlug) {
                    $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();

                    // Updating attributes for filter sidebar
                    if ($currentCategory) {
                        $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                            $query->where('category_id', $currentCategory->id);
                        })->with('attributevalue')->get();
                    }
                }
            }

            // For brand-specific shop page
            $currentBrand = Brand::with('categories')->where('slug', $slug)->first();
            if ($currentBrand) {
                $productsQuery = Product::where('brand_id', $currentBrand->id);
                $shopPageCategories = $currentBrand->categories;
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

        // Apply price range filtering to the products query
        $productsQuery->whereBetween('sale_price', [$min_price_filter, $max_price_filter]);

        // Fetch paginated products
        $products = $productsQuery->latest()->paginate(1);

        // Determine min and max prices based on the current category's products
        if ($currentCategory) {
            $min_price = $currentCategory->products()->min('sale_price') ?? 0;
            $max_price = $currentCategory->products()->max('sale_price') ?? PHP_INT_MAX;
        } else {
            $min_price = Product::min('sale_price') ?? 0;
            $max_price = Product::max('sale_price') ?? PHP_INT_MAX;
        }

        // Return the shop page view with relevant data
        return view('frontend.shop', [
            'shopPageCategories' => $shopPageCategories,
            'products' => $products,
            'shopPageBrands' => $shopPageBrands,
            'shopPageAttributes' => $shopPageAttributes,
            'currentCategory' => $currentCategory,
            'currentBrand' => $currentBrand,
            'min_price' => $min_price,
            'max_price' => $max_price,
        ]);
    }


    public function filterProducts(Request $request)
    {
        // Retrieve filter inputs from the request
        $brandIds = $request->input('brand_ids', []);
        $attributeValues = $request->input('attribute_values', []);
        $currentSlug = $request->input('current_slug', '');
        $minPrice = $request->input('min_price', 0); // Default min price
        $maxPrice = $request->input('max_price', PHP_INT_MAX); // Default max price
        $sortBy = $request->input('sortby', 'latest'); // Default sort option

        // Initialize the query
        $products = Product::query();

        // Filter by current slug (category or brand)
        if (!empty($currentSlug)) {
            $currentCategory = Category::where('slug', $currentSlug)->first();
            if ($currentCategory) {
                $products->whereHas('categories', function ($query) use ($currentCategory) {
                    $query->where('categories.id', $currentCategory->id);
                });
            }

            $currentBrand = Brand::where('slug', $currentSlug)->first();
            if ($currentBrand) {
                $products->where('brand_id', $currentBrand->id);
            }
        }

        // Apply brand filter
        if (!empty($brandIds)) {
            $products->whereIn('brand_id', $brandIds);
        }

        // Apply attribute values filter
        if (!empty($attributeValues)) {
            foreach ($attributeValues as $attributeValueId) {
                $products->whereHas('attributes', function ($query) use ($attributeValueId) {
                    $query->where('attribute_value_id', $attributeValueId);
                });
            }
        }

        // Apply price range filter
        $products->whereBetween('sale_price', [$minPrice, $maxPrice]);

        // Sort Options
        switch ($sortBy) {
            case 'old_to_new':
                $products->oldest();
                break;
            case 'high_to_low':
                $products->orderBy('sale_price', 'desc');
                break;
            case 'low_to_high':
                $products->orderBy('sale_price', 'asc');
                break;
            default:
                $products->latest();
        }

        // Fetch filtered products
        $products = $products->latest()->paginate(1);

        // Return filtered products as JSON
        return response()->json([
            'html' => view('frontend.partials.pro_slide_list', ['products' => $products])->render()
        ]);
    }
}
