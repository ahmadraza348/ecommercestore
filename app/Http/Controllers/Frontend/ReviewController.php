<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'review' => 'required|string',
        'rating' => 'required|integer|between:1,5',
    ]);

    // Save the review
    Review::create([
        'product_id' => $id,
        'user_name'  => $request->name,
        'user_email' => $request->email,
        'comment'    => $request->review,
        'rating'     => $request->rating,
    ]);

    return back()->with('success', 'Review submitted successfully!');
}
}
