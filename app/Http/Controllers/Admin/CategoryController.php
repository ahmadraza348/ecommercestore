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
            ->whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderby('name', 'asc')
            ->get();

        return view('backend.category.edit', compact('category', 'categories'));
    }


    public function update(
        UpdateCategoryRequest $request,
        Category $category,
        CategoryService $service
    ) {
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


    public function bulkDelete(
        BulkDeleteCategoryRequest $request,
        CategoryService $service
    ) {
        $service->bulkDelete($request->getCategoryIds());

        toastr()->success('Categories deleted successfully');
        return back();
    }


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
