<?php

namespace App\Http\Controllers\Admin;

use App\Models\MetaTag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RelationalCategory;
use Illuminate\Support\Facades\DB;
    use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriesImport;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories_data'] = Category::orderBy('id', 'ASC')->with('parent')->get();
        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::with('subcategories')->whereNull('parent_id')->orderby('name', 'asc')->get();
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
    
   
        // Create the category
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id; // Nullable field for parent category
        $category->status = $request->status;
        $category->description = $request->description;
        if($request->is_featured){
            $category->is_featured = $request->is_featured;
        }
        if ($request->hasFile('image')) {
            $ImageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->image = $request->file('image')->storeAs('images/categories', $ImageName, 'public');
        }
    
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

    public function edit(string $id)
    {
        // Fetch the current category being edited
        $category = Category::findOrFail($id);
        
        // Fetch all categories except the one being edited
        $categories = Category::with('subcategories.subcategories')
            ->whereNull('parent_id')  // Include parent category
            ->where('id', '!=', $id)  // Exclude current category
            ->orderby('name', 'asc')
            ->get();
            // dd($categories);
    
        // Pass the categories and the category being edited to the view
        return view('backend.category.edit', compact('category', 'categories'));
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
        if($request->is_featured){
            $category->is_featured = $request->is_featured;
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->image = $request->file('image')->storeAs('images/categories', $imageName, 'public');
        }

        // Save the updated category data
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
     RelationalCategory::where('category_id', $category->id )->delete();
    //    $relational_categories->delete();

        $category->delete();
        toastr()->success('Category Deleted Successfully');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'category_ids' => 'required|string', // Ensure category_ids is provided and is a string
        ]);
    
        $categoryIds = explode(',', $request->category_ids);
    
        try {
            // Begin database transaction
            DB::beginTransaction();
    
            // Delete relational categories
            RelationalCategory::whereIn('category_id', $categoryIds)->delete();
    
            // Delete categories
            Category::whereIn('id', $categoryIds)->delete();
    
            // Commit transaction
            DB::commit();
    
            toastr()->success('Categories deleted successfully.');
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
    
            toastr()->error('Failed to delete categories: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    
        return redirect()->back();
    }


public function import(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'categories_file' => 'required|mimes:xlsx,csv',
    ]);

    // Import the file using Laravel Excel
    try {
        Excel::import(new CategoriesImport, $request->file('categories_file'));
        return redirect()->back();
        
            toastr()->success('Categories imported successfully!.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to import categories: ' . $e->getMessage());
    }
}

}