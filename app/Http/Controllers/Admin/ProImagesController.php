<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProImagesRequest;
use Illuminate\Http\Request;
use App\Services\Admin\ProImagesService;

class ProImagesController extends Controller
{
    protected ProImagesService $service;

    public function __construct(ProImagesService $service)
    {
        $this->service = $service;
    }

    public function add_pro_images(int $product_id)
    {
        return view(
            'backend.product.images',
            $this->service->allImages($product_id)
        );
    }

    public function store_pro_images(ProImagesRequest $request)
    {
        $this->service->storeImages($request->validated());

        return back()->with('success', 'Images uploaded successfully');
    }

    public function update_pro_images(Request $request)
    {
        $request->validate([
            'images' => 'required|array'
        ]);

        $this->service->updateImages($request->input('images'));

        return back()->with('success', 'Images updated successfully');
    }

    public function bulk_delete_images(Request $request)
    {
        $request->validate([
            'delete_ids' => 'required|array'
        ]);

        $this->service->bulkDelete($request->input('delete_ids'));

        return back()->with('success', 'Selected images deleted');
    }
}