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
      $colors = Attribute::where('slug', 'color')->with('attributevalue')->first();
      $product = Product::findOrFail($product_id);
      $attribute_data = Attribute::where('id',  $product->attribute_id)->with('attributevalue')->first(); 


      return view('backend.pro_attr.add', compact(
         'attribute_data',
         'colors',
         'product'
      ));
   }

   public function fetch_pro_attr($product_id)
{
    try {
        $data = ProAttributeValue::with(['color', 'attribute_value'])
            ->where('product_id', $product_id)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}  


   public function store_pro_attr(Request $request)
   {
      try {

            ProAttributeValue::create([
               'product_id' => $request->product_id,
               'attribute_id' => $request->attribute_id ?? null,
               'color_id' => $request->color_id ,
               'attribute_value_id' =>  $request->varient_id ?? null,
               'itemcode' => $request->itemcode,
               'stock' => $request->stock,
               'price' => $request->price,
            ]);
         

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


   public function update_pro_attr(Request $request)
{
    try {
        $attr = ProAttributeValue::findOrFail($request->id);

        $attr->update([
            'color_id' => $request->color_id,
            'attribute_value_id' => $request->varient_id ?? null,
            'attribute_id' => $request->attribute_id ?? null,
            'itemcode' => $request->itemcode,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product attribute updated successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
public function delete_pro_attr($id)
{
    try {
        $attr = ProAttributeValue::findOrFail($id);
        $attr->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product attribute deleted successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}

}
