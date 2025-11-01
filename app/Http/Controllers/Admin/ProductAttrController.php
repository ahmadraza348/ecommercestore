<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Product;
class ProductAttrController extends Controller
{
   public function add_pro_attr($id){
      $product = Product::where('id', $id)->first();
      $data['attribute_data'] = Attribute::where('id', $product->attribute_id)->with('attributevalue')->first();
      $data['colors'] = Attribute::where('slug', 'color')->with('attributevalue')->first();

      // dd( $data['colors']);
    return view ('backend.pro_attr.add', $data) ;
   }
}
