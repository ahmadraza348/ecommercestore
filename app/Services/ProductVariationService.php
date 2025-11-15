<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProAttributeValue;
use Illuminate\Support\Collection;

class ProductVariationService
{
    public function __construct(
        private ProductColorService $colorService
    ) {}

    public function getVariationData(Product $product): array
    {
        return match($product->product_variation_type) {
            'simple' => $this->getSimpleProductData($product),
            'color_varient' => $this->getColorVariantData($product),
            'color_attribute_varient' => $this->getColorAttributeVariantData($product),
            default => $this->getSimpleProductData($product),
        };
    }

    protected function getSimpleProductData(Product $product): array
    {
        return [
            'colors' => collect([]),
            'defaultColor' => null,
            'variants' => collect([]),
        ];
    }

    protected function getColorVariantData(Product $product): array
    {
        $colors = $this->colorService->getColorsData($product);
        $defaultColor = $colors->first();

        return [
            'colors' => $colors,
            'defaultColor' => $defaultColor,
            'variants' => collect([]),
        ];
    }

    protected function getColorAttributeVariantData(Product $product): array
    {
        $colors = $this->colorService->getColorsData($product);
        $defaultColor = $colors->first();

        return [
            'colors' => $colors,
            'defaultColor' => $defaultColor,
            'variants' => $defaultColor ? 
                $this->colorService->getVariantsForColor($product, $defaultColor['color_id']) : 
                collect([]),
        ];
    }
}