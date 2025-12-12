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
            ->whereNull('parent_id')
            ->with('subcategories')
            ->get();

        $data['attributes'] = Attribute::where('status', 1)->with('attributevalue')->get();
        $data['brands'] = Brand::where('status', 1)->get();
        return view('backend.product.create', $data);
    }


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
                ' attribute_id',
                ' product_variation_type',
                'long_description',
                'brand_id',
            ]);
            if ($request->hasFile('video')) {
                $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
                $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');
            }
            // Create Product
            $product = Product::create($data);


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

    public function edit(string $id)
    {
        // Fetch product with its categories
        $data['pro_data'] = Product::findOrFail($id);


        $data['all_category_data'] = Category::where('status', '1')
            ->whereNull('parent_id')
            ->with('subcategories.subcategories')
            ->get();
        $data['selected_categories'] = $data['pro_data']->categories->pluck('id')->toArray();

        $data['attributes'] = Attribute::where('status', 1)->with('attributevalue')->get();
        $data['brands'] = Brand::where('status', 1)->get();
        return view('backend.product.edit', $data);
    }

    public function getAttributeValues($id)
    {
        $attributeValues = AttributeValue::where('attribute_id', $id)->get(['id', 'name']);
        return response()->json($attributeValues);
    }


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
                'product_variation_type',
                'label',
                'is_featured',
                'short_description',
                'long_description',
                'brand_id',
                'attribute_id',
            ]);

            if ($request->hasFile('video')) {
                $videoName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
                $data['video'] = $request->file('video')->storeAs('videos/products', $videoName, 'public');
            }

            // Update Product Basic Data
            $product->update($data);

            // Update Categories
            $categories = $request->input('category', []);

            // Delete existing categories
            RelationalCategory::where('product_id', $product->id)->delete();

            // Insert new categories
            foreach ($categories as $categoryId) {
                RelationalCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $categoryId,
                    'metaable_id' => $product->id,
                    'metaable_type' => Product::class,
                ]);
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
