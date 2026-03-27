<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopPageService
{
public function getShopData($request, $slug = null, $subslug = null, $childslug = null, $superchildslug = null)
{
    $productsQuery = Product::query();

    $currentCategory = null;
    $currentBrand = null;

    // ---------------- PRICE FILTER ----------------
    $min_price_filter = $request->input('min_price', 0);
    $max_price_filter = $request->input('max_price', PHP_INT_MAX);

    // ---------------- CATEGORY / BRAND DETECTION ----------------
    if ($slug) {

        // CATEGORY ROOT
        $currentCategory = Category::where('slug', $slug)->first();

        foreach ([$subslug, $childslug, $superchildslug] as $s) {
            if ($currentCategory && $s) {
                $currentCategory = $currentCategory->subcategories()
                    ->where('slug', $s)
                    ->first();
            }
        }

        if ($currentCategory) {
            $productsQuery->whereHas('categories', function ($q) use ($currentCategory) {
                $q->where('categories.id', $currentCategory->id);
            });
        }

        // BRAND
        $currentBrand = Brand::where('slug', $slug)->first();

        if ($currentBrand) {
            $productsQuery->where('brand_id', $currentBrand->id);
        }
    }

    // ---------------- MAIN PRODUCTS ----------------
    $productsQuery->whereBetween('sale_price', [$min_price_filter, $max_price_filter]);

    $products = $productsQuery->latest()->paginate(12);

    // ---------------- ✅ CATEGORY DISPLAY FIX ----------------
    if (!$slug) {
        // /shop → parent categories
        $shopPageCategories = Category::whereNull('parent_id')
            ->whereHas('products')
            ->get();

    } else {

        if ($currentCategory) {

            if ($currentCategory->subcategories()->exists()) {

                // show children of current category
                $shopPageCategories = $currentCategory->subcategories()
                    ->whereHas('products')
                    ->get();

            } else {
                // no children → empty
                $shopPageCategories = collect();
            }

        } else {
            $shopPageCategories = collect();
        }
    }

    // ---------------- BRANDS ----------------
    $shopPageBrands = Brand::whereHas('products', function ($q) use ($currentCategory) {
        if ($currentCategory) {
            $q->whereHas('categories', function ($q2) use ($currentCategory) {
                $q2->where('categories.id', $currentCategory->id);
            });
        }
    })->get();

    // ---------------- COLORS ----------------
    $shopPageColors = Color::whereHas('products', function ($q) use ($currentCategory) {
        if ($currentCategory) {
            $q->whereHas('categories', function ($q2) use ($currentCategory) {
                $q2->where('categories.id', $currentCategory->id);
            });
        }
    })->get();

    // ---------------- ATTRIBUTES ----------------
    $shopPageAttributes = Attribute::whereHas('attributevalue.products', function ($q) use ($currentCategory) {
        if ($currentCategory) {
            $q->whereHas('categories', function ($q2) use ($currentCategory) {
                $q2->where('categories.id', $currentCategory->id);
            });
        }
    })
    ->with(['attributevalue' => function ($q) use ($currentCategory) {
        $q->whereHas('products', function ($q2) use ($currentCategory) {
            if ($currentCategory) {
                $q2->whereHas('categories', function ($q3) use ($currentCategory) {
                    $q3->where('categories.id', $currentCategory->id);
                });
            }
        });
    }])
    ->get();

    // ---------------- PRICE RANGE ----------------
    $min_price = (clone $productsQuery)->min('sale_price') ?? 0;
    $max_price = (clone $productsQuery)->max('sale_price') ?? 0;

    return [
        'shopPageCategories' => $shopPageCategories,
        'shopPageBrands' => $shopPageBrands,
        'shopPageAttributes' => $shopPageAttributes,
        'shopPageColors' => $shopPageColors,
        'products' => $products,
        'currentCategory' => $currentCategory,
        'currentBrand' => $currentBrand,
        'min_price' => $min_price,
        'max_price' => $max_price,
    ];
}

    // ---------------- FILTER AJAX ----------------

public function filterProducts(Request $request)
{
    $products = Product::query();

    $brandIds = $request->input('brand_ids', []);
    $attributeValues = $request->input('attribute_values', []);
    $colorIds = $request->input('color_ids', []);
    $currentSlug = $request->input('current_slug', '');
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', PHP_INT_MAX);
    $sortBy = $request->input('sortby', 'latest');

    // ---------------- CATEGORY / BRAND ----------------
    if (!empty($currentSlug)) {

        $category = Category::where('slug', $currentSlug)->first();
        if ($category) {
            $products->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            });
        }

        $brand = Brand::where('slug', $currentSlug)->first();
        if ($brand) {
            $products->where('brand_id', $brand->id);
        }
    }

    // ---------------- BRAND FILTER ----------------
    if (!empty($brandIds)) {
        $products->whereIn('brand_id', $brandIds);
    }

    // ---------------- ✅ MAIN FIX (IMPORTANT) ----------------
    if (!empty($attributeValues) || !empty($colorIds)) {
        $products->whereHas('proAttributeValuesRecords', function ($q) use ($attributeValues, $colorIds) {

            if (!empty($attributeValues)) {
                $q->whereIn('attribute_value_id', $attributeValues);
            }

            if (!empty($colorIds)) {
                $q->whereIn('color_id', $colorIds);
            }

        });
    }

    // ---------------- PRICE ----------------
    $products->whereBetween('sale_price', [$minPrice, $maxPrice]);

    // ---------------- SORT ----------------
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

    return $products->paginate(12);
}
}