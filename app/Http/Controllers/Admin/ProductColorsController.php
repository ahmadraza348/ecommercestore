<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductColorsController extends Controller
{
public function index()
{
    $colors = Color::latest()->get();
    return view('backend.colors.index', compact('colors'));
}

public function create()
{
    return view('backend.colors.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:colors,name',
        'slug' => 'required|string|unique:colors,slug',
        'color_code' => 'required|string',
        'status' => 'required|in:1,0',
    ]);

    Color::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'color_code' => $request->color_code,
        'status' => $request->status,
    ]);

    toastr()->success('Color added successfully');
    return redirect()->route('colors.index');
}

public function edit($id)
{
    $color = Color::findOrFail($id);
    return view('backend.colors.edit', compact('color'));
}

public function update(Request $request, $id)
{
    $color = Color::findOrFail($id);

    $request->validate([
        'name' => 'required|string|unique:colors,name,' . $id,
        'slug' => 'required|string|unique:colors,slug,' . $id,
        'color_code' => 'required|string',
        'status' => 'required|in:1,0',
    ]);

    $color->update([
        'name' => $request->name,
        'slug' => $request->slug,
        'color_code' => $request->color_code,
        'status' => $request->status,
    ]);

    toastr()->success('Color updated successfully');
    return redirect()->route('colors.index');
}

public function destroy($id)
{
    $color = Color::findOrFail($id);
    $color->delete();

    toastr()->success('Color deleted successfully');
    return back();
}

}
