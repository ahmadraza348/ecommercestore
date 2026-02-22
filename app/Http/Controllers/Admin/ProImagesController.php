<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;
use App\Services\Admin\ProImagesService;

class ProImagesController extends Controller
{
    protected $service;
    public function __construct(ProImagesService $service){
        $this->service = $service;
     }

    public function add_pro_images($product_id)
    {
        $data = $this->service->add($product_id);
        return view('backend.product.images', $data);
    }


    // UPLOAD MULTIPLE IMAGES
    public function store_pro_images(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'images.*'   => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach ($request->file('images') as $file) {

            $path = $file->store('product-images', 'public'); // FIXED

            ProductImages::create([
                'product_id' => $request->product_id,
                'color_id'   => $request->color_id,
                'image'      => $path,
                'is_featured' => 0,
                'is_back'     => 0,
                'sort_order'  => 1,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully');
    }


    // UPDATE ALL IMAGES AT ONCE
    public function update_pro_images(Request $request)
    {
        foreach ($request->images as $id => $data) {

            ProductImages::where('id', $id)->update([
                'color_id'    => $data['color_id'],
                'is_featured' => isset($data['is_featured']) ? 1 : 0,
                'is_back'     => isset($data['is_back']) ? 1 : 0,
                'sort_order'  => $data['sort_order'],
            ]);
        }

        return back()->with('success', 'Images updated successfully');
    }


    // BULK DELETE
    public function bulk_delete_images(Request $request)
    {
        if (!$request->delete_ids) {
            return back()->with('error', 'No images selected');
        }

        $ids = explode(',', $request->delete_ids);

        $images = ProductImages::whereIn('id', $ids)->get();

        foreach ($images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        return back()->with('success', 'Selected images deleted');
    }
}