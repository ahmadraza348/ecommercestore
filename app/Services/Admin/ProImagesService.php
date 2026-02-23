<?php
namespace App\Services\Admin;

use App\Models\ProductImages;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProImagesService
{
    public function allImages(int $product_id): array
    {
        $product = Product::findOrFail($product_id);

        return [
            'product' => $product,
            'colors'  => Color::where('status', 1)->get(),
            'images'  => ProductImages::where('product_id', $product_id)
                            ->orderBy('sort_order')
                            ->get(),
        ];
    }

    public function storeImages(array $data): void
    {
        DB::transaction(function () use ($data) {

            $productId = $data['product_id'];

            $lastSortOrder = ProductImages::where('product_id', $productId)->max('sort_order') ?? 0;

            foreach ($data['images'] as $file) {

                $path = $file->store('product-images', 'public');

                ProductImages::create([
                    'product_id'  => $productId,
                    'image'       => $path,
                    'color_id'    => $data['color_id'] ?? null,
                    'is_featured' => 0,
                    'is_back'     => 0,
                    'sort_order'  => ++$lastSortOrder,
                ]);
            }
        });
    }

    public function updateImages(array $images): void
    {
        DB::transaction(function () use ($images) {

            foreach ($images as $id => $value) {

                $image = ProductImages::find($id);

                if (!$image) {
                    continue; // skip invalid id
                }

                $image->update([
                    'color_id'    => $value['color_id'] ?? null,
                    'is_featured' => isset($value['is_featured']) ? 1 : 0,
                    'is_back'     => isset($value['is_back']) ? 1 : 0,
                    'sort_order'  => $value['sort_order'] ?? $image->sort_order,
                ]);
            }
        });
    }

 public function bulkDelete( $delete_ids): void
{
    DB::transaction(function () use ($delete_ids) {

            $ids = explode(',', $delete_ids);

         $images = ProductImages::whereIn('id', $ids)->get();

        foreach ($images as $img) {

            if (!empty($img->image) && Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }

            $img->delete();
        }
    });
}
    
    public function bulk_delete($ids_string)
    {
        $ids = explode(',', $ids_string);
        $images = ProductImages::whereIn('id', $ids)->get();

        foreach ($images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }
    }
}