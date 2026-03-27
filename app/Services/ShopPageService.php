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
        $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
        $shopPageBrands = Brand::where('status', 1)->get();
        $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
        $shopPageColors = Color::where('status', 1)->whereHas('products')->get();

        $productsQuery = Product::query();
        $currentCategory = null;
        $currentBrand = null;

        $min_price_filter = $request->input('min_price', 0);
        $max_price_filter = $request->input('max_price', PHP_INT_MAX);

        if ($slug) {
            $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
            if ($currentCategory) {
                $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                    $query->where('category_id', $currentCategory->id);
                })->with('attributevalue')->get();

                      $shopPageColors = Color::where('status', 1)->whereHas('products')->get();

            }

            foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
                if ($currentCategory && $currentSlug) {
                    $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();

                    if ($currentCategory) {
                        $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
                            $query->where('category_id', $currentCategory->id);
                        })->with('attributevalue')->get();
                                $shopPageColors = Color::where('status', 1)->whereHas('products')->get();

                    }
                }
            }

            $currentBrand = Brand::with('categories')->where('slug', $slug)->first();
            if ($currentBrand) {
                $productsQuery = Product::where('brand_id', $currentBrand->id);
                $shopPageCategories = $currentBrand->categories;
            }

            if ($currentCategory) {
                $shopPageCategories = $currentCategory->subcategories;
                $productsQuery = $currentCategory->products();
                $shopPageBrands = Brand::whereHas('categories', function ($query) use ($currentCategory) {
                    $query->where('category_id', $currentCategory->id);
                })->get();
            }
        }

        $productsQuery->whereBetween('sale_price', [$min_price_filter, $max_price_filter]);

        $products = $productsQuery->latest()->paginate(12);

        $min_price = $currentCategory ? $currentCategory->products()->min('sale_price') ?? 0 : Product::min('sale_price') ?? 0;
        $max_price = $currentCategory ? $currentCategory->products()->max('sale_price') ?? PHP_INT_MAX : Product::max('sale_price') ?? PHP_INT_MAX;

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

    public function filterProducts(Request $request)
    {
        // dd($request->all());
        $brandIds = $request->input('brand_ids', []);
        $attributeValues = $request->input('attribute_values', []);
        $colorIds = $request->input('color_ids', []);
        $currentSlug = $request->input('current_slug', '');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);
        $sortBy = $request->input('sortby', 'latest');

        $products = Product::query();

        if (! empty($currentSlug)) {

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

        if (! empty($brandIds)) {
            $products->whereIn('brand_id', $brandIds);
        }

        if (! empty($attributeValues)) {
            foreach ($attributeValues as $attributeValueId) {
                $products->whereHas('attributes', function ($query) use ($attributeValueId) {
                    $query->where('attribute_value_id', $attributeValueId);
                });
            }
        }

        if (! empty($colorIds)) {
            $products->whereHas('colors', function ($query) use ($colorIds) {
                $query->whereIn('color_id', $colorIds);
            });
        }
      

        $products->whereBetween('sale_price', [$minPrice, $maxPrice]);

        // Fix: do NOT override sorting after switch
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
