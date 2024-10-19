<?php

namespace App\Http\Controllers\Admin;

use App\Models\MetaTag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$data['categories'] = Category::orderBy('name', 'asc')->with('parent')->get();
// dd($data['category']);
        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategory.subcategory')->whereNull('parent_id')->orderby('name', 'asc')->get();
        return view('backend.category.create', $data);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug'
        ]);
    
        // Store the image if it exists
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        } else {
            $imageName = null; // No image uploaded
        }
    
        // Create the category
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id; // Nullable field for parent category
        $category->image = $imageName; // Save the image name if uploaded
        $category->status = $request->status;
        $category->description = $request->description;
        $category->is_featured = $request->is_featured; // Default to 0 if not checked
    
        // Save the category
        $category->save();
    
        // Create the meta tags associated with the category
        $metaTag = new MetaTag();
        $metaTag->meta_title = $request->meta_title;
        $metaTag->meta_keywords = $request->meta_keywords;
        $metaTag->meta_description = $request->meta_description;
        $category->metaTag()->save($metaTag);
    
        // Redirect with success message
        toastr()->success('Category created successfully');
        return redirect()->route('category.index');
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
        $data['category'] = Category::findOrFail($id);
        $data['categories'] = Category::with('subcategory.subcategory')->whereNull('parent_id')->orderby('name', 'asc')->get();

        return view('backend.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id, // Ignore the current category's slug for uniqueness check
        ]);
    
        // Find the category
        $category = Category::findOrFail($id);
    
        // Update category details
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id; // Nullable field for parent category
        $category->status = $request->status;
        $category->description = $request->description;
        $category->is_featured = $request->is_featured; // Default to 0 if not checked
    
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }
    
            // Upload the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = $imageName; // Save the new image name
        }
    
        // Save the updated category
        $category->save();
    
        // Update or create meta tags
        $metaTag = $category->metaTag ?: new MetaTag(); // If no meta tag exists, create a new one
        $metaTag->meta_title = $request->meta_title;
        $metaTag->meta_keywords = $request->meta_keywords;
        $metaTag->meta_description = $request->meta_description;
    
        // Save the meta tag (whether it's a new one or an update)
        $category->metaTag()->save($metaTag);
    
        // Redirect with a success message
        toastr()->success('Category updated successfully');
        return redirect()->route('category.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        toastr()->success('Category Deleted Successfully');
        return redirect()->back();
    }
    
}
