<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProAttributeValue;
use Illuminate\Support\Collection;

class ProductColorService
{
    public function getColorsData(Product $product): Collection
    {
        $colorRows = ProAttributeValue::where('product_id', $product->id)
            ->whereNotNull('color_id')
            ->with('color')
            ->get();

        if ($colorRows->isEmpty()) {
            return collect([]);
        }

        return $colorRows->groupBy('color_id')->map(function ($rows, $colorId) use ($product) {
            $colorOnly = $rows->firstWhere('attribute_value_id', null);
            $defaultRow = $colorOnly ?? $rows->first();

            return [
                'color_id' => (int)$colorId,
                'color' => $rows->first()->color,
                'default_price' => $defaultRow->price ?? $product->sale_price,
                'default_itemcode' => $defaultRow->itemcode ?? null,
                'has_variants' => $rows->contains(fn($r) => !is_null($r->attribute_value_id)),
            ];
        })->values();
    }

    public function getColorVariants(Product $product, int $colorId): array
    {
        $rows = ProAttributeValue::where('product_id', $product->id)
            ->where('color_id', $colorId)
            ->with(['attribute_value', 'color'])
            ->get();

        if ($rows->isEmpty()) {
            return [
                'variants' => [],
                'default' => null,
                'price' => $product->sale_price,
            ];
        }

        $variants = $this->extractVariants($rows);
        $default = $this->getDefaultSelection($rows, $variants, $product);

        return [
            'variants' => $variants,
            'default' => $default,
        ];
    }

    public function getVariantsForColor(Product $product, ?int $colorId): Collection
    {
        if (!$colorId) {
            return collect([]);
        }

        $rows = ProAttributeValue::where('product_id', $product->id)
            ->where('color_id', $colorId)
            ->whereNotNull('attribute_value_id')
            ->with('attribute_value')
            ->get();

        return $this->extractVariants($rows);
    }

    protected function extractVariants(Collection $rows): Collection
    {
        return $rows->whereNotNull('attribute_value_id')->map(function ($variant) {
            return [
                'id' => $variant->id,
                'attribute_value_id' => $variant->attribute_value_id,
                'name' => $variant->attribute_value->name ?? null,
                'price' => $variant->price,
                'stock' => $variant->stock,
                'itemcode' => $variant->itemcode,
            ];
        })->values();
    }

    protected function getDefaultSelection(Collection $rows, Collection $variants, Product $product): array
    {
        $colorOnly = $rows->firstWhere('attribute_value_id', null);
        
        if ($colorOnly) {
            return [
                'type' => 'color-only',
                'price' => $colorOnly->price,
                'itemcode' => $colorOnly->itemcode,
                'stock' => $colorOnly->stock,
            ];
        }

        if ($variants->isNotEmpty()) {
            $firstVariant = $variants->first();
            return [
                'type' => 'variant',
                'variant_id' => $firstVariant['attribute_value_id'],
                'price' => $firstVariant['price'],
                'itemcode' => $firstVariant['itemcode'],
                'stock' => $firstVariant['stock'],
            ];
        }

        return [
            'type' => 'product',
            'price' => $product->sale_price,
        ];
    }
}