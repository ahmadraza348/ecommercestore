<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomePageController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::get('/featured-categories', [HomePageController::class, 'fetch_featured_categories'])->name('api.featured_categories.fetch');
Route::get('/featured-products', [HomePageController::class, 'fetch_featured_products'])->name('api.featured_products.fetch');
Route::get('/hot-deals', [HomePageController::class, 'fetch_hot_deals'])->name('api.hot_deals.fetch');
Route::get('/sale-products', [HomePageController::class, 'fetch_sale_products'])->name('api.sale_products.fetch');
Route::get('/new-arrivals', [HomePageController::class, 'fetch_new_arrivals'])->name('api.new_arrivals.fetch');
Route::get('/brands', [HomePageController::class, 'fetch_brands'])->name('api.brands.fetch');
