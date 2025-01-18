<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\MetaTag;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\ProImages;
use App\Models\ProCategory;
use App\Models\RelationalCategory;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('backend.product.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::where('status', '1')
            ->whereNull('parent_id')   //get only parent categories
            ->with('subcategories')   //get all (nested) sub & child categories within parent category in proper sequence
            ->get();

        $data['attributes'] = Attribute::where('status', 1)->with('attributevalue')->get();
        $data['attribute_colors'] = AttributeValue::whereHas('attribute', function ($query) {
            $query->where('slug', 'color');
        })->get();
        $data['brands'] = Brand::where('status', 1)->get();
        return view('backend.product.create', $data);
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $rules = [
    //             'name' => 'required|string|max:255',
    //             'slug' => 'required|string|max:255|unique:products,slug',
    //             'sku' => 'required|string|max:255|unique:products,sku',
    //             'sale_price' => 'required|numeric|max:99999',
    //             'barcode' => 'required|string|max:255',
    //             'stock' => 'required|integer|max:99999',
    //             'featured_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:200',
    //             'back_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
    //             'gallery_images' => 'required|array',
    //             'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:200',
    //              'video' => 'nullable|mimes:mp4,mov,avi|max:10240'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             foreach ($validator->errors()->all() as $error) {
    //                 toastr()->error($error);
    //             }
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         // Store Product Basic Data
    //         $data = $request->only([
    //             'name',
    //             'slug',
    //             'sku',
    //             'sale_price',
    //             'previous_price',
    //             'purchase_price',
    //             'barcode',
    //             'stock',
    //             'tags',
    //             'label',
    //             'is_featured',
    //             'short_description',
    //             'long_description',
    //             'featured_image',
    //             'back_image',
    //             'brand_id',
    //         ]);

    //         if ($request->hasFile('featured_image')) {
    //             $featuredImageName = time() . '_' . uniqid() . '.' . $request->file('featured_image')->getClientOriginalExtension();
    //             $data['featured_image']= $request->file('featured_image')->storeAs('images/products', $featuredImageName, 'public');
    //         }

    //         if ($request->hasFile('back_image')) {
    //             $backImageName = time() . '_' . uniqid() . '.' . $request->file('back_image')->getClientOriginalExtension();
    //             $data['back_image'] = $request->file('back_image')->storeAs('images/products', $backImageName, 'public');
    //         }

    //         if ($request->hasFile('video')) {
    //             $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
    //             $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');                
    //         }


    //         // Create Product
    //         $product = Product::create($data);

    //         if ($request->hasFile('gallery_images')) {
    //             $colors = $request->input('colors'); // Get color IDs from the request

    //             foreach ($request->file('gallery_images') as $index => $galleryImage) {
    //                 $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
    //                 $publicGalleryPath = $galleryImage->storeAs('images/products/gallery', $galleryImageName, 'public');

    //                 ProImages::create([
    //                     'product_id' => $product->id,
    //                     'image' => $publicGalleryPath,
    //                     'color_id' => $colors[$index] ?? null // Map the color ID if available
    //                 ]);
    //             }
    //         }


    //         $categories = $request->input('category', []);
    //         $subcategories = $request->input('subcategory', []);
    //         $childcategories = $request->input('childcategory', []);
    //         $superchildcategory = $request->input('superchild', []);
    //         $allCategories = array_merge($categories, $subcategories, $childcategories, $superchildcategory);
    //         // Store data in RelationalCategory table
    //         foreach ($allCategories as $categoryId) {
    //             RelationalCategory::create([
    //                 'product_id' => $product->id,
    //                 'category_id' => $categoryId,
    //                 'metaable_id' => $product->id,
    //                 'metaable_type' => Product::class,
    //             ]);
    //         }


    //         // Save Product Attributes
    //         $attributes = $request->input('attribute', []);
    //         $attributeValues = $request->input('attribute_value', []);
    //         $attributeStocks = $request->input('attribute_stock', []);
    //         $attributePrices = $request->input('attribute_price', []);
    //         $itemCodes = $request->input('itemcode', []);

    //         foreach ($attributes as $index => $attributeId) {
    //             $product->attributes()->attach($attributeId, [
    //                 'attribute_value_id' => $attributeValues[$index],
    //                 'stock' => $attributeStocks[$index],
    //                 'price' => $attributePrices[$index],
    //                 'itemcode' => $itemCodes[$index]
    //             ]);
    //         }

    //         // Save Product Meta Tags
    //         $metaTag = new MetaTag();
    //         $metaTag->meta_title = $request->meta_title;
    //         $metaTag->meta_keywords = $request->meta_keywords;
    //         $metaTag->meta_description = $request->meta_description;
    //         $product->metaTag()->save($metaTag);

    //         toastr()->success('Product saved successfully!');
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         toastr()->error($e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug',
                'sku' => 'required|string|max:255|unique:products,sku',
                'sale_price' => 'required|numeric|max:99999',
                'barcode' => 'required|string|max:255',
                'stock' => 'required|integer|max:99999',
                'featured_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:200',
                'back_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
                'gallery_images' => 'required|array',
                'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:200',
                'video' => 'nullable|mimes:mp4,mov,avi|max:10240'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    toastr()->error($error);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Store Product Basic Data
            $data = $request->only([
                'name',
                'slug',
                'sku',
                'sale_price',
                'previous_price',
                'purchase_price',
                'barcode',
                'stock',
                'tags',
                'label',
                'is_featured',
                'short_description',
                'long_description',
                'brand_id',
            ]);

            if ($request->hasFile('featured_image')) {
                $featuredImageName = time() . '_' . uniqid() . '.' . $request->file('featured_image')->getClientOriginalExtension();
                $data['featured_image'] = $request->file('featured_image')->storeAs('images/products', $featuredImageName, 'public');
            }

            if ($request->hasFile('back_image')) {
                $backImageName = time() . '_' . uniqid() . '.' . $request->file('back_image')->getClientOriginalExtension();
                $data['back_image'] = $request->file('back_image')->storeAs('images/products', $backImageName, 'public');
            }

            if ($request->hasFile('video')) {
                $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
                $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');
            }

            // Create Product
            $product = Product::create($data);

            // Store Gallery Images
            if ($request->hasFile('gallery_images')) {
                $colors = $request->input('colors', []);

                foreach ($request->file('gallery_images') as $index => $galleryImage) {
                    $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                    $publicGalleryPath = $galleryImage->storeAs('images/products/gallery', $galleryImageName, 'public');

                    ProImages::create([
                        'product_id' => $product->id,
                        'image' => $publicGalleryPath,
                        'color_id' => $colors[$index] ?? null
                    ]);
                }
            }

            // Store Product Categories
            $categories = $request->input('category', []);
            $subcategories = $request->input('subcategory', []);
            $childcategories = $request->input('childcategory', []);
            $superchildcategory = $request->input('superchild', []);
            $allCategories = array_merge($categories, $subcategories, $childcategories, $superchildcategory);

            foreach ($allCategories as $categoryId) {
                RelationalCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $categoryId,
                    'metaable_id' => $product->id,
                    'metaable_type' => Product::class,
                ]);
            }

            // Save Product Attributes and Attribute Values
            $itemCodes = $request->input('itemcode', []);
            $attributeValues = $request->input('attribute_value', []);
            $attributeStocks = $request->input('attribute_stock', []);
            $attributePrices = $request->input('attribute_price', []);

            foreach ($itemCodes as $index => $itemCode) {
                foreach ($attributeValues as $attributeId => $values) {
                    if (!empty($values[$index])) {
                        $product->attributes()->attach($attributeId, [
                            'attribute_value_id' => $values[$index],
                            'stock' => $attributeStocks[$index],
                            'price' => $attributePrices[$index],
                            'itemcode' => $itemCode
                        ]);
                    }
                }
            }

            // Save Product Meta Tags
            $metaTag = new MetaTag();
            $metaTag->meta_title = $request->meta_title;
            $metaTag->meta_keywords = $request->meta_keywords;
            $metaTag->meta_description = $request->meta_description;
            $product->metaTag()->save($metaTag);

            toastr()->success('Product saved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // Fetch product with its categories
        $data['pro_data'] = Product::with([
            'gallery_images',
            'attributes' => function ($query) {
                $query->orderBy('itemcode', 'asc');
            }
        ])->findOrFail($id);


        $data['all_category_data'] = Category::where('status', '1')
            ->whereNull('parent_id')
            ->with('subcategories.subcategories')
            ->get();
        $data['selected_categories'] = $data['pro_data']->categories->pluck('id')->toArray();

        $data['attributes'] = Attribute::where('status', 1)->with('attributevalue')->get();
        $data['attribute_colors'] = AttributeValue::whereHas('attribute', function ($query) {
            $query->where('slug', 'color');
        })->get();
        $data['selected_attribute'] = $data['pro_data']->attributes->pluck('id')->toArray();
        $data['brands'] = Brand::where('status', 1)->get();
        return view('backend.product.edit', $data);
    }

    public function getAttributeValues($id)
    {
        $attributeValues = AttributeValue::where('attribute_id', $id)->get(['id', 'name']);
        return response()->json($attributeValues);
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {

    //     dd($request->all());
    //     try {
    //         // Validation Rules
    //         $rules = [
    //             'name' => 'required|string|max:255',
    //             'slug' => 'required|string|max:255|unique:products,slug,' . $id,
    //             'sku' => 'required|string|max:255|unique:products,sku,' . $id,
    //             'sale_price' => 'required|numeric|max:99999',
    //             'barcode' => 'required|string|max:255',
    //             'stock' => 'required|integer|max:99999',
    //             'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
    //             'back_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
    //             'gallery_images' => 'nullable|array',
    //             'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:200',
    //             'video' => 'nullable|mimes:mp4,mov,avi|max:10240'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             foreach ($validator->errors()->all() as $error) {
    //                 toastr()->error($error);
    //             }
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         // Fetch Product Data
    //         $product = Product::findOrFail($id);
    //         $data = $request->only([
    //             'name',
    //             'slug',
    //             'sku',
    //             'sale_price',
    //             'previous_price',
    //             'purchase_price',
    //             'barcode',
    //             'stock',
    //             'tags',
    //             'label',
    //             'is_featured',
    //             'short_description',
    //             'long_description',
    //             'brand_id',

    //         ]);

    //         // Handle Featured Image
    //         if ($request->hasFile('featured_image')) {
    //             $featuredImageName = time() . '_' . uniqid() . '.' . $request->file('featured_image')->getClientOriginalExtension();
    //             $data['featured_image'] = $request->file('featured_image')->storeAs('images/products', $featuredImageName, 'public');
    //         }

    //         // Handle Back Image
    //         if ($request->hasFile('back_image')) {
    //             $backImageName = time() . '_' . uniqid() . '.' . $request->file('back_image')->getClientOriginalExtension();
    //             $data['back_image'] = $request->file('back_image')->storeAs('images/products', $backImageName, 'public');
    //         }

    //         // Handle Video
    //         if ($request->hasFile('video')) {
    //             $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
    //             $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');
    //         }

    //         // Update Product
    //         $product->update($data);

    //         // Update Product Gallery Images
    //         if ($request->hasFile('gallery_images')) {
    //             // Delete existing gallery images for the product
    //             ProImages::where('product_id', $id)->delete();

    //             // Process each uploaded gallery image
    //             foreach ($request->file('gallery_images') as $index => $galleryImage) {
    //                 $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
    //                 $publicGalleryPath = $galleryImage->storeAs('images/products/gallery', $galleryImageName, 'public');

    //                 ProImages::create([
    //                     'product_id' => $product->id,
    //                     'image' => $publicGalleryPath,
    //                     'color_id' => $request->input('color_ids')[$index] ?? null, // Capture color_id for each image
    //                 ]);
    //             }
    //         }

    //         // Update color_id for existing gallery images
    //         if ($request->has('existing_colors')) {
    //             foreach ($request->existing_colors as $imageId => $colorId) {
    //                 $galleryImage = ProImages::find($imageId);
    //                 if ($galleryImage) {
    //                     $galleryImage->update(['color_id' => $colorId]);
    //                 }
    //             }
    //         }


    //         if ($request->has('category')) {
    //             // First, detach old categories from the brand
    //             RelationalCategory::where('metaable_id', $product->id)
    //                 ->where('metaable_type', Product::class)
    //                 ->delete();

    //             $categories = $request->input('category', []);
    //             foreach ($categories as $categoryId) {
    //                 RelationalCategory::create([
    //                     'product_id' => $product->id,
    //                     'category_id' => $categoryId,
    //                     'metaable_id' => $product->id,
    //                     'metaable_type' => Product::class,
    //                 ]);
    //             }
    //         }

    //         $attributes = $request->input('attribute_value', []);
    //         $itemcodes = $request->input('itemcode', []);
    //         $stocks = $request->input('attribute_stock', []);
    //         $prices = $request->input('attribute_price', []);

    //         // Clear existing attribute relations for the product
    //         $product->attributes()->detach();

    //         // Reattach updated attributes with their pivot data
    //         foreach ($itemcodes as $index => $itemcode) {
    //             foreach ($attributes as $attributeId => $values) {
    //                 if (isset($values[$index])) {
    //                     $product->attributes()->attach($attributeId, [
    //                         'itemcode' => $itemcode,
    //                         'attribute_value_id' => $values[$index],
    //                         'stock' => $stocks[$index],
    //                         'price' => $prices[$index]
    //                     ]);
    //                 }
    //             }
    //         }


    //         // Update Product Meta Tags
    //         $metaTag = $product->metaTag ?: new MetaTag();
    //         $metaTag->meta_title = $request->meta_title;
    //         $metaTag->meta_keywords = $request->meta_keywords;
    //         $metaTag->meta_description = $request->meta_description;
    //         $product->metaTag()->save($metaTag);

    //         toastr()->success('Product updated successfully!');
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         toastr()->error($e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }
    public function update(Request $request, string $id)
    {
        try {
            // Validation Rules
            $rules = [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug,' . $id,
                'sku' => 'required|string|max:255|unique:products,sku,' . $id,
                'sale_price' => 'required|numeric|max:99999',
                'barcode' => 'required|string|max:255',
                'stock' => 'required|integer|max:99999',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
                'back_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
                'gallery_images' => 'nullable|array',
                'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:200',
                'video' => 'nullable|mimes:mp4,mov,avi|max:10240'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    toastr()->error($error);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Fetch Product Data
            $product = Product::findOrFail($id);
    
            $data = $request->only([
                'name',
                'slug',
                'sku',
                'sale_price',
                'previous_price',
                'purchase_price',
                'barcode',
                'stock',
                'tags',
                'label',
                'is_featured',
                'short_description',
                'long_description',
                'brand_id',
            ]);
    
            // Handle Images and Video Uploads
            if ($request->hasFile('featured_image')) {
                $featuredImageName = time() . '_' . uniqid() . '.' . $request->file('featured_image')->getClientOriginalExtension();
                $data['featured_image'] = $request->file('featured_image')->storeAs('images/products', $featuredImageName, 'public');
            }
    
            if ($request->hasFile('back_image')) {
                $backImageName = time() . '_' . uniqid() . '.' . $request->file('back_image')->getClientOriginalExtension();
                $data['back_image'] = $request->file('back_image')->storeAs('images/products', $backImageName, 'public');
            }
    
            if ($request->hasFile('video')) {
                $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
                $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');
            }
    
            // Update Product Basic Data
            $product->update($data);
    
            // Update Product Attributes
            $itemcodes = $request->input('itemcode', []);
            $attributes = $request->input('attribute_value', []);
            $stocks = $request->input('attribute_stock', []);
            $prices = $request->input('attribute_price', []);
    
            // Detach existing attributes
            $product->attributes()->detach();
    
            // Reattach attributes with updated values
            foreach ($attributes as $attributeId => $attributeValues) {
                foreach ($attributeValues as $itemCode => $valueId) {
                    if (isset($stocks[$itemCode]) && isset($prices[$itemCode])) {
                        $product->attributes()->attach($attributeId, [
                            'itemcode' => $itemCode,
                            'attribute_value_id' => $valueId,
                            'stock' => $stocks[$itemCode],
                            'price' => $prices[$itemCode],
                        ]);
                    }
                }
            }
    
            // Update Meta Tags
            $metaTag = $product->metaTag ?: new MetaTag();
            $metaTag->meta_title = $request->meta_title;
            $metaTag->meta_keywords = $request->meta_keywords;
            $metaTag->meta_description = $request->meta_description;
            $product->metaTag()->save($metaTag);
    
            toastr()->success('Product updated successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    

    public function deleteGalleryImage(Request $request)
    {
        try {
            $imageId = $request->id;
            $galleryImage = ProImages::findOrFail($imageId);
            $galleryImage->delete();
            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function destroy(string $id)
    {
        $pro = Product::findOrFail($id);
        $pro->delete();
        toastr()->success('Product Deleted Successfully');
        return redirect()->back();
    }
    public function restore_product()
    {
        $data['products'] = Product::onlyTrashed()->get();
        return view('backend.product.restore', $data);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        toastr()->success('Product Restored Successfully');
        return redirect()->route('product.index');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        toastr()->success('Product Permanently Deleted Successfully');
        return redirect()->back();
    }
    public function bulkDelete(Request $request)
    {
        $prodIds = explode(',', $request->pro_ids);
        Product::whereIn('id', $prodIds)->delete();
        toastr()->success('Products deleted successfully.');
        return redirect()->back();
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'products_file' => 'required|mimes:xlsx,csv',
        ]);

        // Import the file using Laravel Excel
        try {
            Excel::import(new ProductsImport, $request->file('products_file'));
            return redirect()->back();

            toastr()->success('Categories imported successfully!.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import categories: ' . $e->getMessage());
        }
    }
}
