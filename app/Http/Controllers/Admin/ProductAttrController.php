<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
class ProductAttrController extends Controller
{
   public function add_pro_attr(){
        $data['attributes'] = Attribute::where('status', 1)->with('attributevalue')->get();
    return view ('backend.pro_attr.add', $data) ;
   }
}
