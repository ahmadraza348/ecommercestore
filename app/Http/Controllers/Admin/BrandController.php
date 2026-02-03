<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\RelationalCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Services\Admin\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    /**
     * Inject the BrandService via the constructor.
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        $data['brand'] = Brand::orderby('name', 'ASC')->get();
        return view('backend.brand.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::with('subcategories')->whereNull('parent_id')->orderby('name', 'asc')->get();
        return view('backend.brand.create', $data);
    }

    public function store(StoreBrandRequest $request)
    {
        // $request->validated() returns only data defined in the BrandRequest rules
        $this->brandService->createBrand($request->validated());

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

 public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->brandService->updateBrand($brand, $request->validated());

        toastr()->success('Brand updated successfully');
        return redirect()->route('brand.index');
    }

  public function destroy(Brand $brand)
    {
        $brand->delete();
        toastr()->success('Brand Deleted Successfully');
        return redirect()->back();
    }

    /**
     * Handle bulk deletion of brands.
     */
    public function bulkDelete(Request $request)
    {
        if ($request->filled('brand_ids')) {
            $brandIds = explode(',', $request->brand_ids);
            Brand::whereIn('id', $brandIds)->delete();
            toastr()->success('Brands deleted successfully.');
        } else {
            toastr()->error('No brands selected.');
        }

        return redirect()->back();
    }
}
