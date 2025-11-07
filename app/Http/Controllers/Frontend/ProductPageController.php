<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProAttributeValue;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    // Show product detail page. Blade will initially receive product + prepared color list.
    public function index($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['gallery_images', 'attributes']) // eager load useful relations
            ->firstOrFail();

        // Prepare colors list from pro_attribute_values
        // We want each color once, plus a "default price" for that color (either color-only price or first variant price)
        $colorRows = ProAttributeValue::where('product_id', $product->id)
            ->whereNotNull('color_id')
            ->with(['color', 'attribute_value'])
            ->get();

        // group rows by color_id
        $colorsGrouped = $colorRows->groupBy('color_id')->map(function ($rows, $colorId) use ($product) {
            // Try to find a color-only row (attribute_value_id null)
            $colorOnly = $rows->firstWhere('attribute_value_id', null);

            // If there's a color-only row, use that as default price, otherwise use first row price
            $defaultRow = $colorOnly ?? $rows->first();

            return [
                'color_id' => (int)$colorId,
                'color' => $rows->first()->color ?? null,
                'default_price' => $defaultRow->price ?? $product->sale_price,
                // Also include a sample itemcode/stock if useful
                'default_itemcode' => $defaultRow->itemcode ?? null,
                'has_variants' => $rows->contains(fn($r) => !is_null($r->attribute_value_id)),
            ];
        })->values();

        // Choose default color: first in the list (you can change choice rule here)
        $defaultColor = $colorsGrouped->first();

        return view('frontend.product-detail', [
            'product' => $product,
            'colors' => $colorsGrouped,
            'defaultColor' => $defaultColor,
        ]);
    }

    // AJAX: return colors and their basic info (used if you want to fetch dynamically)
    public function colorsData(Product $product)
    {
        $rows = ProAttributeValue::where('product_id', $product->id)
            ->whereNotNull('color_id')
            ->with('color')
            ->get()
            ->groupBy('color_id')
            ->map(function ($group, $colorId) use ($product) {
                $colorOnly = $group->firstWhere('attribute_value_id', null);
                $defaultRow = $colorOnly ?? $group->first();
                return [
                    'color_id' => (int)$colorId,
                    'color' => $group->first()->color,
                    'default_price' => $defaultRow->price ?? $product->sale_price,
                    'has_variants' => $group->contains(fn($r) => !is_null($r->attribute_value_id)),
                ];
            })->values();

        return response()->json([
            'status' => 'success',
            'data' => $rows,
        ]);
    }

    // AJAX: when user selects a color, return available variants for that color (if any)
    // Request: product (route model), color_id (query param)
    public function colorVariants(Request $request, Product $product)
    {
        $colorId = $request->query('color_id');

        if (!$colorId) {
            return response()->json(['status' => 'error', 'message' => 'color_id required'], 400);
        }

        $rows = ProAttributeValue::where('product_id', $product->id)
            ->where('color_id', $colorId)
            ->with(['attribute_value', 'color'])
            ->get();

        if ($rows->isEmpty()) {
            return response()->json(['status' => 'success', 'data' => [
                'variants' => [],
                'default' => null,
                'price' => $product->sale_price,
            ]]);
        }

        // Group rows by attribute_value_id (null attribute_value_id = color-only)
        $variants = $rows->whereNotNull('attribute_value_id')->map(function ($r) {
            return [
                'id' => $r->id,
                'attribute_value_id' => $r->attribute_value_id,
                'name' => $r->attribute_value ? $r->attribute_value->name : null,
                'price' => $r->price,
                'stock' => $r->stock,
                'itemcode' => $r->itemcode,
            ];
        })->values();

        // Determine default selection price:
        // Priority: color-only row price (attribute_value_id null) as default if exists
        $colorOnly = $rows->firstWhere('attribute_value_id', null);
        if ($colorOnly) {
            $default = [
                'type' => 'color-only',
                'price' => $colorOnly->price,
                'itemcode' => $colorOnly->itemcode,
                'stock' => $colorOnly->stock,
            ];
        } elseif ($variants->isNotEmpty()) {
            // choose first variant as default
            $firstVariant = $variants->first();
            $default = [
                'type' => 'variant',
                'variant_id' => $firstVariant['attribute_value_id'],
                'price' => $firstVariant['price'],
                'itemcode' => $firstVariant['itemcode'],
                'stock' => $firstVariant['stock'],
            ];
        } else {
            // fallback to product price
            $default = [
                'type' => 'product',
                'price' => $product->sale_price,
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'variants' => $variants,
                'default' => $default,
            ],
        ]);
    }
}
