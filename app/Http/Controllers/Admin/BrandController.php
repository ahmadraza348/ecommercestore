<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\RelationalCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['brand'] = Brand::orderby('name', 'ASC')->get();
        return view('backend.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategories')->whereNull('parent_id')->orderby('name', 'asc')->get();
        return view('backend.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'website' => 'nullable|url',
            'description' => 'nullable|string',

        ]);

        // Create the brand
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->website = $request->website;
        $brand->description = $request->description;
        $brand->status = $request->status;

        // Handle the image upload
        if ($request->hasFile('image')) {
            $ImageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $brand->image = $request->file('image')->storeAs('images/brands', $ImageName, 'public');
        }
        $brand->save();

        // Combine categories, subcategories, and childcategories into one array
        $categories = $request->input('category', []);
        $subcategories = $request->input('subcategory', []);
        $childcategories = $request->input('childcategory', []);
        $superchildcategory = $request->input('superchild', []);
        $allCategories = array_merge($categories, $subcategories, $childcategories, $superchildcategory);
        // Store data in RelationalCategory table
        foreach ($allCategories as $categoryId) {
            RelationalCategory::create([
                'brand_id' => $brand->id,
                'category_id' => $categoryId,
                'metaable_id' => $brand->id,
                'metaable_type' => Brand::class,
            ]);
        }

        toastr()->success('Brand created successfully');
        return redirect()->route('brand.index');
    }

    public function edit(string $id)
    {
        // Retrieve the brand to edit by ID
        $data['brand'] = Brand::findOrFail($id); // Use findOrFail to ensure brand exists

        // Retrieve all categories, subcategories, and childcategories
        $data['all_category_data'] = Category::where('status', '1')
            ->whereNull('parent_id') // Only top-level categories
            ->with('subcategories.subcategories') // Load subcategories recursively
            ->get();

        // Get selected categories for the current brand (using a pivot table or relationship)
        $data['selected_categories'] = $data['brand']->categories->pluck('id')->toArray();

        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $id,
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve the brand by ID
        $brand = Brand::findOrFail($id);

        // Update brand attributes
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->website = $request->website;
        $brand->description = $request->description;
        $brand->status = $request->status;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $brand->image = $request->file('image')->storeAs('images/brands', $imageName, 'public');
        }

        // Save the updated brand
        $brand->save();
        if ($request->has('category')) {
            // First, detach old categories from the brand
            RelationalCategory::where('metaable_id', $brand->id)
                ->where('metaable_type', Brand::class)
                ->delete();

            $categories = $request->input('category', []);
            foreach ($categories as $categoryId) {
                RelationalCategory::create([
                    'brand_id' => $brand->id,
                    'category_id' => $categoryId,
                    'metaable_id' => $brand->id,
                    'metaable_type' => Brand::class,
                ]);
            }
        }

        toastr()->success('Brand updated successfully');
        return redirect()->route('brand.index');
    }

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        toastr()->success('brand Deleted Successfully');
        return redirect()->back();
    }
    public function bulkDelete(Request $request)
    {
        $brandIds = explode(',', $request->brand_ids);
        Brand::whereIn('id', $brandIds)->delete();
        toastr()->success('Brands deleted successfully.');
        return redirect()->back();
    }
}
