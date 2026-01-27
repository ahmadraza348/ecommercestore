<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributevalueController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAttrController;
use App\Http\Controllers\Admin\ProductColorsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProImagesController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\CheckoutPageController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\OrderInvoiceController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Frontend\ShopPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/hash', function () {
    return Hash::make('ahmadraza');
});
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/shop/{slug?}/{subslug?}/{childslug?}/{superchildslug?}', [ShopPageController::class, 'index'])->name('shop');
Route::post('/shop/filter-products', [ShopPageController::class, 'filterProducts'])->name('shop.filter');
Route::get('quick-view-product/{id}', [HomePageController::class, 'getProduct']);
Route::get('/product/{slug}', [ProductPageController::class, 'index'])->name('pro.details');
Route::post('/product/add-to-cart', [ProductPageController::class, 'addToCart'])->name('addToCart');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartPageController::class, 'cart'])->name('cartPage');
    Route::post('/update', [CartPageController::class, 'cart_update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartPageController::class, 'cart_remove'])->name('cart.remove');
    Route::post('/apply-coupon', [CartPageController::class, 'applyCoupon'])->name('coupon.apply');
});
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutPageController::class, 'index'])->name('checkoutPage');
});
Route::post('/place-order', [CheckoutPageController::class, 'placeOrder'])->name('order.place');
Route::get('/order-thankyou/{order_number}', [CheckoutPageController::class, 'order_thankyou'])->name('order.thankyou');

Route::get('/order/{order}/invoice', [OrderInvoiceController::class, 'show'])
    ->name('order.invoice');

Route::get('/order/{order}/invoice/pdf', [OrderInvoiceController::class, 'download'])
    ->name('order.invoice.pdf');

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

    Route::prefix('colors')->name('colors.')->group(function () {
        Route::get('/', [ProductColorsController::class, 'index'])->name('index');
        Route::get('/create', [ProductColorsController::class, 'create'])->name('create');
        Route::post('/store', [ProductColorsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductColorsController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductColorsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ProductColorsController::class, 'destroy'])->name('destroy');
    });

    // Route::middleware(['checkPermission:menu.roles_permissions'])->group(function () {

    // Roles
    Route::prefix('roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'all_roles'])->name('index');
        Route::post('store', [RoleController::class, 'add_roles'])->name('store');
        Route::get('edit/{role}', [RoleController::class, 'edit_roles'])->name('edit');
        Route::put('update/{role}', [RoleController::class, 'update_roles'])->name('update');
        Route::delete('delete/{role}', [RoleController::class, 'delete_roles'])->name('delete');
    });

    Route::prefix('permissions')->name('admin.permissions.')->group(function () {
        Route::get('/', [RoleController::class, 'all_permissions'])->name('index');
        Route::post('store', [RoleController::class, 'add_permissions'])->name('store');
        Route::get('edit/{permission}', [RoleController::class, 'edit_permissions'])->name('edit');
        Route::put('update/{permission}', [RoleController::class, 'update_permissions'])->name('update');
        Route::delete('delete/{permission}', [RoleController::class, 'delete_permissions'])->name('delete');
    });

    Route::prefix('roles-permissions')->name('admin.roles_permissions.')->group(function () {
        Route::get('/', [RoleController::class, 'all_roles_permissions'])->name('index');
        Route::get('/create', [RoleController::class, 'create_roles_permissions'])->name('create');
        Route::post('store', [RoleController::class, 'store_roles_permissions'])->name('store');
        Route::get('edit/{role_permission}', [RoleController::class, 'edit_roles_permissions'])->name('edit');
        Route::put('update/{role_permission}', [RoleController::class, 'update_roles_permissions'])->name('update');
        Route::delete('delete/{role_permission}', [RoleController::class, 'delete_roles_permissions'])->name('delete');
    });

    Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::post('/store', [CouponController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CouponController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CouponController::class, 'destroy'])->name('destroy');
    });

    Route::get('/restore-products', [ProductController::class, 'restore_product'])->name('product.restore');
    Route::get('/get-attribute-values/{id}', [ProductController::class, 'getAttributeValues'])->name('getAttributeValues');
    Route::delete('/gallery-image/delete', [ProductController::class, 'deleteGalleryImage'])->name('galleryimg.delete');
    Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    //    Product Attribute Routes
    // Route::post('/store-product-attribute', [ProductAttrController::class, 'store_pro_attr'])->name('store.pro.attribute');
    Route::get('/add-product-attribute/{id}', [ProductAttrController::class, 'add_pro_attr'])->name('add.pro.attribute');
    Route::post('products/store-attributes', [ProductAttrController::class, 'store_pro_attr'])
        ->name('admin.product.store-attributes');
    Route::get('products/{id}/attributes', [ProductAttrController::class, 'fetch_pro_attr'])
        ->name('admin.product.fetchAttributes');
    Route::post('products/update-attribute', [ProductAttrController::class, 'update_pro_attr'])
        ->name('admin.product.updateAttribute');
    Route::delete('/products/delete-attribute/{id}', [ProductAttrController::class, 'delete_pro_attr'])
        ->name('admin.product.delete-attribute');
    //    Product Attribute Routes

    //    Product images Routes
    Route::prefix('products')->group(function () {
        Route::get('/add-images/{id}', [ProImagesController::class, 'add_pro_images'])->name('add.pro.images');
        Route::post('/store-images', [ProImagesController::class, 'store_pro_images'])->name('admin.product.store-images');
        Route::post('/update-images', [ProImagesController::class, 'update_pro_images'])->name('admin.product.update-images');
        Route::delete('/delete-images', [ProImagesController::class, 'bulk_delete_images'])->name('admin.product.delete-images');
    });
    //    Product images Routes

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
