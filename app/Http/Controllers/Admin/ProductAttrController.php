<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute; 
use App\Models\ProAttributeValue; 
use App\Models\Product;
class ProductAttrController extends Controller
{
   public function add_pro_attr($id){
      $data['product'] = Product::where('id', $id)->first();
      $data['attribute_data'] = Attribute::where('id', $data['product']->attribute_id)->with('attributevalue')->first();
      $data['colors'] = Attribute::where('slug', 'color')->with('attributevalue')->first();

      // dd( $data['colors']);
    return view ('backend.pro_attr.add', $data) ;
   }

   public function store_pro_attr(Request $request)
   {
      // Validate all dynamic fields
      $validated = $request->validate([
         'attributes' => 'required|array|min:1',
         'attributes.*.itemcode' => 'required|string|max:255',
         'attributes.*.color' => 'nullable|exists:attribute_values,id',
         'attributes.*.attribute_id' => 'nullable|exists:attribute_values,id',
         'attributes.*.stock' => 'required|numeric|min:0',
         'attributes.*.price' => 'required|numeric|min:0',
      ]);

      try {
         // Loop through each attribute and store it
         foreach ($validated['attributes'] as $attr) {
            ProAttributeValue::create([
               'product_id'        => $request->product_id ?? null, // if you’re passing product_id hidden input
               'itemcode'          => $attr['itemcode'],
               'color_id'          => $attr['color'] ?? null,
               'attribute_value_id' => $attr['attribute_id'] ?? null,
               'stock'             => $attr['stock'],
               'price'             => $attr['price'],
            ]);
         }

         return redirect()->back()->with('success', 'Product attributes added successfully!');
      } catch (\Exception $e) {
         return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
      }
   }
}
