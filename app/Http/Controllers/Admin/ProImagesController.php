<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;

class ProImagesController extends Controller
{
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('backend.product.images', [
            'product' => $product,
            'colors' => Color::all(),
            'images' => $product->images()->orderBy('sort_order')->get()
        ]);
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'images.*' => 'required|image|max:2000',
            'color_id' => 'nullable|exists:colors,id',
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('product-images');

            ProductImages::create([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'image' => $path,
                'sort_order' => ProductImages::where('product_id', $product_id)->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Images uploaded.');
    }

    public function update(Request $request, ProductImages $image)
    {
        $image->update([
            'color_id' => $request->color_id,
            'is_featured' => $request->is_featured ?? 0,
            'is_back' => $request->is_back ?? 0,
            'sort_order' => $request->sort_order
        ]);

        return back()->with('success', 'Image updated.');
    }

    public function destroy(ProductImages $image)
    {
        Storage::delete($image->image);
        $image->delete();

        return back()->with('success', 'Image deleted.');
    }
}

