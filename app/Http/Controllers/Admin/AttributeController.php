<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\RelationalCategory;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['attribute'] = Attribute::OrderBy('name', 'ASC')->get();
        return view('backend.attribute.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategories')->whereNull('parent_id')->orderby('name', 'asc')->get();
        return view('backend.attribute.create', $data);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attributes,slug',
        ]);
 
    
        // Create the category
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->slug = $request->slug;
        $attribute->status = $request->status;
        $attribute->save();

        $categories = $request->input('category', []);
        $subcategories = $request->input('subcategory', []);
        $childcategories = $request->input('childcategory', []);
        $superchildcategory = $request->input('superchild', []);
        $allCategories = array_merge($categories, $subcategories, $childcategories, $superchildcategory);
        // Store data in RelationalCategory table
        foreach ($allCategories as $categoryId) {
            RelationalCategory::create([
                'attribute_id' => $attribute->id,
                'category_id' => $categoryId,
                'metaable_id' => $attribute->id,
                'metaable_type' => Attribute::class,
            ]);
        }

    
        toastr()->success('Attribute created successfully');
        return redirect()->route('attribute.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
              // Fetch the current category being edited
              $data['attribute'] = Attribute::findOrFail($id);
        
              // Fetch all categories except the one being edited
              $data['all_category_data'] = Category::where('status', '1')
              ->whereNull('parent_id') // Only top-level categories
              ->with('subcategories.subcategories') // Load subcategories recursively
              ->get();
  
          // Get selected categories for the current brand (using a pivot table or relationship)
          $data['selected_categories'] = $data['attribute']->categories->pluck('id')->toArray();
          
              // Pass the categories and the category being edited to the view
              return view('backend.attribute.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attributes,slug,' . $id, // Ignore the current category's slug for uniqueness check
        ]);
    
        // Find the category
        $attribute = Attribute::findOrFail($id);
    
        // Update attribute details
        $attribute->name = $request->name;
        $attribute->slug = $request->slug;
        $attribute->status = $request->status;

      
        // Handle image update
      
        $attribute->save();

        if ($request->has('category')) {
            // First, detach old categories from the brand
            RelationalCategory::where('metaable_id', $attribute->id)
                ->where('metaable_type', Attribute::class)
                ->delete();

            $categories = $request->input('category', []);
            foreach ($categories as $categoryId) {
                RelationalCategory::create([
                    'attribute_id' => $attribute->id,
                    'category_id' => $categoryId,
                    'metaable_id' => $attribute->id,
                    'metaable_type' => Attribute::class,
                ]);
            }
        }
    
        toastr()->success('Attribute updated successfully');
        return redirect()->route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Attribute::findOrFail($id);
        $category->delete();
        toastr()->success('Attribute Deleted Successfully');
        return redirect()->back();
    }
}
