<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductGalleryService
{
    public function getColorImages(Product $product, ?int $colorId): Collection
    {
        // First try to get color-specific images
        $images = $product->gallery_images()
            ->where('color_id', $colorId)
            ->get(['id', 'image', 'color_id']);

        // Fallback: if no color-specific images, show default images
        if ($images->isEmpty()) {
            $images = $product->gallery_images()
                ->whereNull('color_id')
                ->get(['id', 'image', 'color_id']);
        }

        return $images;
    }

    public function getDefaultImages(Product $product): Collection
    {
        return $product->gallery_images()
            ->whereNull('color_id')
            ->get(['id', 'image', 'color_id']);
    }

    public function getAllProductImages(Product $product): Collection
    {
        return $product->gallery_images()
            ->get(['id', 'image', 'color_id']);
    }
}