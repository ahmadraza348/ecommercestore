<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributevalueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['value'] = AttributeValue::orderby('name', 'ASC')->get();
        return view('backend.attributevalue.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $data['attributes'] = Attribute::where('status', 1)->orderby('name', 'asc')->get();
        return view('backend.attributevalue.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attributes,slug',
            'attribute_id' => 'required'
        ]);
 
        $value = new AttributeValue();
        $value->name = $request->name;
        $value->slug = $request->slug;
        $value->attribute_id = $request->attribute_id; 
        $value->save();
    
        toastr()->success('Attribute Value created successfully');
        return redirect()->route('attributevalue.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(string $id)
    {
              $attributevalue = AttributeValue::findOrFail($id);    
                 $attributes = Attribute::orderby('name', 'asc')->get();    
              return view('backend.attributevalue.edit', compact('attributevalue', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'attribute_id' => 'required',
            'slug' => 'required|string|max:255|unique:attribute_values,slug,' . $id,
        ]);
    
        // Find the category
        $value = AttributeValue::findOrFail($id);
 
        $value->name = $request->name;
        $value->slug = $request->slug;
        $value->attribute_id = $request->attribute_id; 
        $value->save();
    
    
        toastr()->success('Attribute Value updated successfully');
        return redirect()->route('attributevalue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $category = AttributeValue::findOrFail($id);
        $category->delete();
        toastr()->success('Attribute Value  Deleted Successfully');
        return redirect()->back();
    }
}
