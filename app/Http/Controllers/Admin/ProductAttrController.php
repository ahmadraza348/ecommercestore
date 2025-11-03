<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute; 
use App\Models\ProAttributeValue; 
use App\Models\Product;
class ProductAttrController extends Controller
{
   public function add_pro_attr($product_id){
      $product = Product::with('attributes')->findOrFail($product_id);
      $attribute_data = Attribute::with('attributevalue')->first(); // or however you get it
      $colors = Attribute::where('name', 'Color')->with('attributevalue')->first();

      // Get all product variants for this product
      $variants = \App\Models\ProAttributeValue::with([
         'colorValue',
         'attributeValue'
      ])->where('product_id', $product_id)->get();

      return view('backend.pro_attr.add', compact(
         'product',
         'attribute_data',
         'colors',
         'variants'
      ));
   }

   public function createAttribute($product_id)
   {
      $product = Product::with('attributes')->findOrFail($product_id);
      $attribute_data = Attribute::with('attributevalue')->first(); // or however you get it
      $colors = Attribute::where('name', 'Color')->with('attributevalue')->first();

      // Get all product variants for this product
      $variants = \App\Models\ProAttributeValue::with([
         'colorValue',
         'attributeValue'
      ])->where('product_id', $product_id)->get();

      return view('backend.pro_attr.add', compact(
         'product',
         'attribute_data',
         'colors',
         'variants'
      ));
   }


   public function store_pro_attr(Request $request)
   {
      try {
         $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'attribute_id' => 'nullable|exists:attributes,id',
            'attributes' => 'required|array|min:1',
            'attributes.*.itemcode' => 'required|string',
            'attributes.*.color_id' => 'nullable|exists:attribute_values,id',
            'attributes.*.varient_id' => 'nullable|exists:attribute_values,id',
            'attributes.*.stock' => 'required|numeric|min:0',
            'attributes.*.price' => 'required|numeric|min:0',
         ]);

         foreach ($validated['attributes'] as $attr) {
            ProAttributeValue::create([
               'product_id' => $validated['product_id'],
               'attribute_id' => $validated['attribute_id'],
               'color_id' => $attr['color_id'] ?? null,
               'attribute_value_id' => $attr['varient_id'] ?? null,
               'itemcode' => $attr['itemcode'],
               'stock' => $attr['stock'],
               'price' => $attr['price'],
            ]);
         }

         return response()->json([
            'status' => 'success',
            'message' => 'Product attributes saved successfully!'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
         ], 500);
      }
   }
}
