<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ShopPageController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Admin\AttributevalueController;
use App\Http\Controllers\Admin\ProductAttrController;

Route::get('/hash', function () {
    return Hash::make('ahmadraza');
});
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/shop/{slug?}/{subslug?}/{childslug?}/{superchildslug?}', [ShopPageController::class, 'index'])->name('shop');
Route::post('/shop/filter-products', [ShopPageController::class, 'filterProducts'])->name('shop.filter');
Route::get('quick-view-product/{id}', [HomePageController::class, 'getProduct']);
Route::get('/product/{slug}', [ProductPageController::class, 'index'])->name('pro.details');
// AJAX endpoints
Route::get('/product/{product}/colors-data', [ProductPageController::class, 'colorsData'])->name('product.colorsData');
Route::get('/product/{product}/color-variants', [ProductPageController::class, 'colorVariants'])->name('product.colorVariants');
Route::get('/product/{product}/color-images', [ProductPageController::class, 'colorImages'])
    ->name('product.colorImages');



Route::prefix('admin')->middleware('adminauth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Admin User Routes
    Route::prefix('user')->group(function () {
        Route::get('/', [AdminUserController::class, 'show'])->name('admin.user.show');
        Route::get('/add', [AdminUserController::class, 'add'])->name('admin.user.add');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/profile', [AdminUserController::class, 'profile'])->name('admin.user.profile');
        Route::post('/profile/save/{id}', [AdminUserController::class, 'profile_update'])->name('admin.user.profile.update');
    });
Route::post('/categories/import', [CategoryController::class, 'import'])->name('categories.import');
Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

    Route::resource('category', CategoryController::class)->names('category');
    Route::post('/category/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('category.bulk-delete');
    Route::post('/brand/bulk-delete', [BrandController::class, 'bulkDelete'])->name('brand.bulk-delete');
    Route::post('/product/bulk-delete', [ProductController::class, 'bulkDelete'])->name('product.bulk-delete');

    Route::resource('brand', BrandController::class)->names('brand');
    Route::resource('attribute', AttributeController::class)->names('attribute');
    Route::resource('attributevalue', AttributevalueController::class)->names('attributevalue');
    Route::resource('product', ProductController::class)->names('product');    
    Route::get('/add-product-attribute/{id}', [ProductAttrController::class, 'add_pro_attr'])->name('add.pro.attribute');
    Route::post('/store-product-attribute', [ProductAttrController::class, 'store_pro_attr'])->name('store.pro.attribute');
    Route::get('/restore-products', [ProductController::class, 'restore_product'])->name('product.restore');
    Route::get('/get-attribute-values/{id}', [ProductController::class, 'getAttributeValues'])->name('getAttributeValues');
    Route::delete('/gallery-image/delete', [ProductController::class, 'deleteGalleryImage'])->name('galleryimg.delete');
    Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    Route::post('/admin/products/store-attributes', [ProductAttrController::class, 'store_pro_attr'])
        ->name('admin.product.store-attributes');
        Route::get('/admin/products/{id}/attributes', [ProductAttrController::class, 'fetch_pro_attr'])
    ->name('admin.product.fetchAttributes');
    Route::post('/admin/products/update-attribute', [ProductAttrController::class, 'update_pro_attr'])
    ->name('admin.product.updateAttribute');
Route::delete('/products/delete-attribute/{id}', [ProductAttrController::class, 'delete_pro_attr'])
    ->name('admin.product.delete-attribute');



    // Separate routes for profile functionality
    Route::get('users/profile', [AdminUserController::class, 'profile'])->name('admin.user.profile');
    Route::post('users/profile/save/{id}', [AdminUserController::class, 'profile_update'])->name('admin.user.profile.update');
});
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('login/submit', [AuthController::class, 'login_submit'])->name('admin.login.submit');
    Route::get('login/forget-password', [AuthController::class, 'forgetpass'])->name('admin.forgetpass');
    Route::post('login/forget-password/submit', [AuthController::class, 'submitforgetpass'])->name('admin.forgetpass.submit');
    Route::get('login/reset-password/{token}', [AuthController::class, 'show_reset_pass_form'])->name('reset.password.get');
    Route::post('login/reset-password/{token}', [AuthController::class, 'submit_reset_pass_form'])->name('reset.password.post');
});

// Route::get('/register', [HomePageController::class, 'index'])->name('front.register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
