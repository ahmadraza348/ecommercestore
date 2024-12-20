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
    // public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null)
    // {
    //     // for url = https://domainname/shop
    //     // sending data for shop page
    //     $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
    //     $shopPageBrands = Brand::where('status', 1)->get();
    //     $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
    //     $productsQuery = Product::query();
    //     $currentCategory = null;
    //     $currentBrand = null;

    //     if ($slug) {

    //         // for parent category's shop page
    //         $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
    //         if ($currentCategory) {
    //             $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
    //                 $query->where('category_id', $currentCategory->id);
    //             })->with('attributevalue')->get();
    //         }

    //         // for nest categories's shop page inside parent category
    //         foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
    //             if ($currentCategory && $currentSlug) {
    //                 $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();

    //                 // Sending attributes on filter sidebar 
    //                 if ($currentCategory) {
    //                     $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
    //                         $query->where('category_id', $currentCategory->id);
    //                     })->with('attributevalue')->get();
    //                 }
    //             }
    //         }
     
    //         $currentBrand = Brand::with('categories')->where('slug', $slug)->first();
    //         if ($currentBrand) {
    //             $productsQuery = Product::where('brand_id', $currentBrand->id);
    //             $shopPageCategories = $currentBrand->categories;
    //         }

    //         // If a specific category is found, update related data
    //         if ($currentCategory) {
    //             $shopPageCategories = $currentCategory->subcategories;
    //             $productsQuery = $currentCategory->products();
    //             $shopPageBrands = Brand::whereHas('categories', function ($query) use ($currentCategory) {
    //                 $query->where('category_id', $currentCategory->id);
    //             })->get();
    //         }
    //     }

    //     // Fetch paginated products
    //     $products = $productsQuery->latest()->paginate(12);

    //     // Return the shop page view with relevant data
    //     return view('frontend.shop', [
    //         'shopPageCategories' => $shopPageCategories,
    //         'products' => $products,
    //         'shopPageBrands' => $shopPageBrands,
    //         'shopPageAttributes' => $shopPageAttributes,
    //         'currentCategory' => $currentCategory,
    //         'currentBrand' => $currentBrand,
    //     ]);
    // }

    // public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null)
    // {
    //     // for url = https://domainname/shop
    //     // sending data for shop page
    //     $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
    //     $shopPageBrands = Brand::where('status', 1)->get();
    //     $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
    //     $productsQuery = Product::query();
    //     $currentCategory = null;
    //     $currentBrand = null;
    
    //     if ($slug) {
    //         // for parent category's shop page
    //         $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
    //         if ($currentCategory) {
    //             $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
    //                 $query->where('category_id', $currentCategory->id);
    //             })->with(['attributevalue' => function ($query) use ($currentCategory) {
    //                 $query->withCount(['products' => function ($query) use ($currentCategory) {
    //                     $query->whereHas('categories', function ($query) use ($currentCategory) {
    //                         $query->where('categories.id', $currentCategory->id);
    //                     });
    //                 }]);
    //             }])->get();
    //         }
    
    //         // for nested categories' shop page inside parent category
    //         foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
    //             if ($currentCategory && $currentSlug) {
    //                 $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();
    
    //                 // Sending attributes on filter sidebar 
    //                 if ($currentCategory) {
    //                     $shopPageAttributes = Attribute::whereHas('categories', function ($query) use ($currentCategory) {
    //                         $query->where('category_id', $currentCategory->id);
    //                     })->with(['attributevalue' => function ($query) use ($currentCategory) {
    //                         $query->withCount(['products' => function ($query) use ($currentCategory) {
    //                             $query->whereHas('categories', function ($query) use ($currentCategory) {
    //                                 $query->where('categories.id', $currentCategory->id);
    //                             });
    //                         }]);
    //                     }])->get();
    //                 }
    //             }
    //         }
    
    //         // for brand shop page
    //         $currentBrand = Brand::with('categories')->where('slug', $slug)->first();
    //         if ($currentBrand) {
    //             $productsQuery = Product::where('brand_id', $currentBrand->id);
    //             $shopPageCategories = $currentBrand->categories;
    //         }
    
    //         // If a specific category is found, update related data
    //         if ($currentCategory) {
    //             $shopPageCategories = $currentCategory->subcategories;
    //             $productsQuery = $currentCategory->products();
    //             $shopPageBrands = Brand::whereHas('categories', function ($query) use ($currentCategory) {
    //                 $query->where('category_id', $currentCategory->id);
    //             })->get();
    //         }
    //     }
    
    //     // Fetch paginated products
    //     $products = $productsQuery->latest()->paginate(12);
    
    //     // Return the shop page view with relevant data
    //     return view('frontend.shop', [
    //         'shopPageCategories' => $shopPageCategories,
    //         'products' => $products,
    //         'shopPageBrands' => $shopPageBrands,
    //         'shopPageAttributes' => $shopPageAttributes,
    //         'currentCategory' => $currentCategory,
    //         'currentBrand' => $currentBrand,
    //     ]);
    // }
    

// Helper function to fetch attributes with product count for a specific category
private function getAttributesForCategory($category)
{
    // Retrieve all attributes that are associated with the given category
    return Attribute::whereHas('categories', function ($query) use ($category) {
        // Filter attributes by category_id to ensure the attribute is linked to the given category
        $query->where('category_id', $category->id);
    })
    // Eager load the attribute values (e.g., color, size) for each attribute
    ->with(['attributevalue' => function ($query) use ($category) {
        // For each attribute value, count the number of products associated with it in the given category
        $query->withCount(['products' => function ($query) use ($category) {
            // Filter products by category to ensure we are counting only products in the given category
            $query->whereHas('categories', function ($query) use ($category) {
                // Ensure the product is in the same category as the one passed
                $query->where('categories.id', $category->id);
            });
        }]);
    }])
    // Execute the query and return the result
    ->get();
}




public function index($slug = null, $subslug = null, $childslug = null, $superchildslug = null)
{
    // for url = https://domainname/shop
    // sending data for shop page
    $shopPageCategories = Category::where('status', 1)->whereNull('parent_id')->get();
    $shopPageBrands = Brand::where('status', 1)->get();
    $shopPageAttributes = Attribute::where('status', 1)->with('attributevalue')->get();
    $productsQuery = Product::query();
    $currentCategory = null;
    $currentBrand = null;

    if ($slug) {
        // for parent category's shop page
        $currentCategory = Category::with('subcategories')->where('slug', $slug)->first();
        if ($currentCategory) {
            $shopPageAttributes = $this->getAttributesForCategory($currentCategory);
        }

        // for nested categories' shop page inside parent category
        foreach ([$subslug, $childslug, $superchildslug] as $currentSlug) {
            if ($currentCategory && $currentSlug) {
                $currentCategory = $currentCategory->subcategories->where('slug', $currentSlug)->first();

                // Sending attributes on filter sidebar 
                if ($currentCategory) {
                    $shopPageAttributes = $this->getAttributesForCategory($currentCategory);
                }
            }
        }

        // for brand shop page
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

    // Fetch paginated products
    $products = $productsQuery->latest()->paginate(12);

    // Return the shop page view with relevant data
    return view('frontend.shop', [
        'shopPageCategories' => $shopPageCategories,
        'products' => $products,
        'shopPageBrands' => $shopPageBrands,
        'shopPageAttributes' => $shopPageAttributes,
        'currentCategory' => $currentCategory,
        'currentBrand' => $currentBrand,
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
