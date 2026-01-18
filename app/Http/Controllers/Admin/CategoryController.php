<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\ImportCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Requests\Admin\BulkDeleteCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $data['categories_data'] = Category::orderBy('id', 'ASC')->with('parent')->get();
        return view('backend.category.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::with('subcategories')->whereNull('parent_id')->orderby('name', 'asc')->get();
        return view('backend.category.create', $data);
    }


    public function store(StoreCategoryRequest $request, CategoryService $service)
    {
        $service->create($request->validated());

        toastr()->success('Category created successfully');
        return redirect()->route('category.index');
    }


    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::with('subcategories.subcategories')
            ->whereNull('parent_id')  // Include parent category
            ->where('id', '!=', $id)  // Exclude current category
            ->orderby('name', 'asc')
            ->get();

        return view('backend.category.edit', compact('category', 'categories'));
    }


    public function update(UpdateCategoryRequest $request, $id, CategoryService $service)
    {
        $category = Category::findOrFail($id);

        $service->update($category, $request->validated());

        toastr()->success('Category updated successfully');
        return redirect()->route('category.index');
    }


    public function destroy($id, CategoryService $service)
    {
        $category = Category::findOrFail($id);

        $service->delete($category);

        toastr()->success('Category Deleted Successfully');
        return back();
    }


    // public function bulkDelete(Request $request)
    // {
    //     // Validate incoming request
    //     $request->validate([
    //         'category_ids' => 'required|string', // Ensure category_ids is provided and is a string
    //     ]);

    //     $categoryIds = explode(',', $request->category_ids);

    //     try {
    //         // Begin database transaction
    //         DB::beginTransaction();

    //         // Delete relational categories
    //         RelationalCategory::whereIn('category_id', $categoryIds)->delete();

    //         // Delete categories
    //         Category::whereIn('id', $categoryIds)->delete();

    //         // Commit transaction
    //         DB::commit();

    //         toastr()->success('Categories deleted successfully.');
    //     } catch (\Exception $e) {
    //         // Rollback transaction in case of error
    //         DB::rollBack();

    //         toastr()->error('Failed to delete categories: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }

    //     return redirect()->back();
    // }

    public function bulkDelete(
        BulkDeleteCategoryRequest $request,
        CategoryService $service
    ) {
        $service->bulkDelete($request->getCategoryIds());

        toastr()->success('Categories deleted successfully');
        return back();
    }



    //     public function import(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'categories_file' => 'required|mimes:xlsx,csv',
    //     ]);

    //     // Import the file using Laravel Excel
    //     try {
    //         Excel::import(new CategoriesImport, $request->file('categories_file'));
    //         return redirect()->back();

    //             toastr()->success('Categories imported successfully!.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to import categories: ' . $e->getMessage());
    //     }
    // }

    public function import(
        ImportCategoryRequest $request,
        CategoryService $service
    ) {
        try {
            $service->importCategories($request->file('categories_file'));

            toastr()->success('Categories imported successfully');
            return back();
        } catch (\Throwable $e) {
            toastr()->error('Import failed');
            return back();
        }
    }
}
