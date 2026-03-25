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
use App\Http\Controllers\Frontend\OrderPageController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\OrderInvoiceController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Frontend\ShopPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SalesController;

Route::get('/hash', function () {
    return Hash::make('ahmadraza');
});
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/search', [HomePageController::class, 'search'])->name('products.search');
Route::get('/shop/{slug?}/{subslug?}/{childslug?}/{superchildslug?}', [ShopPageController::class, 'index'])->name('shop');
Route::post('/shop/filter-products', [ShopPageController::class, 'filterProducts'])->name('shop.filter');
Route::get('quick-view-product/{id}', [HomePageController::class, 'getProduct']);
Route::get('/product/{slug}', [ProductPageController::class, 'index'])->name('pro.details');
Route::post('/product/add-to-cart', [ProductPageController::class, 'addToCart'])->name('addToCart');

Route::get('/category-products/{id}', [HomePageController::class, 'getCategoryProducts'])->name('category.products');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartPageController::class, 'cart'])->name('cartPage');
    Route::post('/update', [CartPageController::class, 'cart_update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartPageController::class, 'cart_remove'])->name('cart.remove');
    Route::post('/apply-coupon', [CartPageController::class, 'applyCoupon'])->name('coupon.apply');
});
Route::prefix('checkout')->group(function () {
    Route::get('/', [OrderPageController::class, 'index'])->name('checkoutPage');
});
Route::post('/place-order', [OrderPageController::class, 'placeOrder'])->name('order.place');
Route::get('/order-thankyou/{order_number}', [OrderPageController::class, 'order_thankyou'])->name('order.thankyou');

Route::get('/order/{order}/invoice', [OrderInvoiceController::class, 'show'])
    ->name('order.invoice');

Route::get('/order/{order}/invoice/pdf', [OrderInvoiceController::class, 'download'])
    ->name('order.invoice.pdf');

// Admin Panel Routes
 Route::prefix('admin')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('admin.login');
        Route::post('login/submit', [AuthController::class, 'login_submit'])->name('admin.login.submit');
        Route::get('login/forget-password', [AuthController::class, 'forgetpass'])->name('admin.forgetpass');
        Route::post('login/forget-password/submit', [AuthController::class, 'submitforgetpass'])->name('admin.forgetpass.submit');
        Route::get('login/reset-password/{token}', [AuthController::class, 'show_reset_pass_form'])->name('reset.password.get');
        Route::post('login/reset-password/{token}', [AuthController::class, 'submit_reset_pass_form'])->name('reset.password.post');
    });

Route::prefix('admin')->middleware('adminauth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Admin User Routes
    Route::prefix('user')->name('admin.user.')->group(function () {
        Route::get('/', [AdminUserController::class, 'show'])->middleware('permission:view_admins')->name('show');
        Route::group(['middleware' => 'permission:create_admins'], function () {
            Route::get('/add', [AdminUserController::class, 'add'])->name('add');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_admins'], function () {
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        });
        Route::group(['middleware' => 'permission:delete_admins'], function () {
            Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('delete');
        });
        Route::get('/profile', [AdminUserController::class, 'profile'])->name('profile');
        Route::post('/profile/save/{id}', [AdminUserController::class, 'profile_update'])->name('profile.update');
    });
    

    // Route::get('users/profile', [AdminUserController::class, 'profile'])->name('admin.user.profile');
    // Route::post('users/profile/save/{id}', [AdminUserController::class, 'profile_update'])->name('admin.user.profile.update');

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->middleware('permission:view_categories')->name('index');
        Route::group(['middleware' => 'permission:create_categories'], function () {
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::post('/import', [CategoryController::class, 'import'])->name('import');
        });
        Route::group(['middleware' => 'permission:edit_categories'], function () {
            Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('update/{category}', [CategoryController::class, 'update'])->name('update');
        });
        Route::group(['middleware' => 'permission:delete_categories'], function () {
            Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });

    Route::prefix('brand')->name('brand.')->group(function () {

        Route::get('/', [BrandController::class, 'index'])->middleware('permission:view_brands')->name('index');
        Route::group(['middleware' => 'permission:create_brands'], function () {
            Route::get('create', [BrandController::class, 'create'])->name('create');
            Route::post('store', [BrandController::class, 'store'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_brands'], function () {
            Route::get('edit/{brand}', [BrandController::class, 'edit'])->name('edit');
            Route::post('update/{brand}', [BrandController::class, 'update'])->name('update');
        });
        Route::delete('delete/{brand}', [BrandController::class, 'destroy'])->middleware('permission:delete_brands')->name('destroy');
        Route::post('bulk-delete', [BrandController::class, 'bulkDelete'])->name('bulk-delete');
    });

    Route::prefix('attribute')->name('attribute.')->group(function () {

        Route::get('/', [AttributeController::class, 'index'])->middleware('permission:view_varients')->name('index');
        Route::group(['middleware' => 'permission:create_varients'], function () {
            Route::get('create', [AttributeController::class, 'create'])->name('create');
            Route::post('store', [AttributeController::class, 'store'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_varients'], function () {
            Route::get('edit/{attribute}', [AttributeController::class, 'edit'])->name('edit');
            Route::post('update/{attribute}', [AttributeController::class, 'update'])->name('update');
        });
        Route::delete('delete/{attribute}', [AttributeController::class, 'destroy'])->middleware('permission:delete_varients')->name('destroy');
    });

    Route::prefix('colors')->name('colors.')->group(function () {
        Route::get('/', [ProductColorsController::class, 'index'])->middleware('permission:view_colors')->name('index');
        Route::group(['middleware' => 'permission:create_colors'], function () {

            Route::get('/create', [ProductColorsController::class, 'create'])->name('create');
            Route::post('/store', [ProductColorsController::class, 'store'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_colors'], function () {
            Route::get('/edit/{color}', [ProductColorsController::class, 'edit'])->name('edit');
            Route::post('/update/{color}', [ProductColorsController::class, 'update'])->name('update');
        });
        Route::delete('/destroy/{color}', [ProductColorsController::class, 'destroy'])->middleware('permission:delete_colors')->name('destroy');
    });

    Route::prefix('attributevalue')->name('attributevalue.')->group(function () {

        Route::get('/', [AttributevalueController::class, 'index'])->middleware('permission:view_varients')->name('index');
        Route::group(['middleware' => 'permission:create_varients'], function () {
            Route::get('create', [AttributevalueController::class, 'create'])->name('create');
            Route::post('store', [AttributevalueController::class, 'store'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_varients'], function () {
            Route::get('edit/{attributevalue}', [AttributevalueController::class, 'edit'])->name('edit');
            Route::put('update/{attributevalue}', [AttributevalueController::class, 'update'])->name('update');
        });
        Route::delete('delete/{attributevalue}', [AttributevalueController::class, 'destroy'])->middleware('permission:delete_varients')->name('destroy');
    });


    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])
            // ->middleware('permission:view_products')
            ->name('index');
        Route::group([
            // 'middleware' => 'permission:create_products'
        ], function () {
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
        });
        Route::group([
            // 'middleware' => 'permission:edit_products'
        ], function () {
            Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::put('update/{product}', [ProductController::class, 'update'])->name('update');
        });
        Route::delete('delete/{product}', [ProductController::class, 'destroy'])
            // ->middleware('permission:delete_products')
            ->name('destroy');
    });

    // Route::resource('product', ProductController::class)->names('product');
    Route::post('/product/bulk-delete', [ProductController::class, 'bulkDelete'])->name('product.bulk-delete');
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

    // Route::get('/get-attribute-values/{id}', [ProductController::class, 'getAttributeValues'])->name('getAttributeValues');
    // Route::delete('/gallery-image/delete', [ProductController::class, 'deleteGalleryImage'])->name('galleryimg.delete');
    Route::get('/restore-products', [ProductController::class, 'restore_product'])->name('product.restore');
    Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    // Product Attribute and images Routes


    Route::prefix('pro-attributes')->name('admin.pro.attribute.')->group(function () {
        Route::get('/add/{id}', [ProductAttrController::class, 'add_pro_attr'])->name('index');
        Route::post('/store', [ProductAttrController::class, 'store_pro_attr'])->name('store');
        Route::get('/fetch/{id}', [ProductAttrController::class, 'fetch_pro_attr'])->name('fetch');
        Route::post('/update/{id}', [ProductAttrController::class, 'update_pro_attr'])->name('update');
        Route::delete('/delete/{id}', [ProductAttrController::class, 'delete_pro_attr'])->name('delete');
    });

    Route::prefix('products')->group(function () {
        Route::get('/add-images/{id}', [ProImagesController::class, 'add_pro_images'])->name('add.pro.images');
        Route::post('/store-images', [ProImagesController::class, 'store_pro_images'])->name('admin.product.store-images');
        Route::post('/update-images', [ProImagesController::class, 'update_pro_images'])->name('admin.product.update-images');
        Route::delete('/delete-images', [ProImagesController::class, 'bulk_delete_images'])->name('admin.product.delete-images');
    });

    // Roles And Permissions Routes start here
    Route::prefix('roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'all_roles'])->name('index')->middleware('permission:view_roles');
        Route::post('store', [RoleController::class, 'add_roles'])->name('store')->middleware('permission:add_roles');
        Route::group(['middleware' => 'permission:edit_roles'], function () {
            Route::get('edit/{role}', [RoleController::class, 'edit_roles'])->name('edit');
            Route::put('update/{role}', [RoleController::class, 'update_roles'])->name('update');
        });
        Route::delete('delete/{role}', [RoleController::class, 'delete_roles'])->name('delete')->middleware('permission:delete_roles');
    });

    Route::prefix('permissions')->name('admin.permissions.')->group(function () {
        Route::get('/', [RoleController::class, 'all_permissions'])->name('index')->middleware('permission:view_permissions');
        Route::post('store', [RoleController::class, 'add_permissions'])->name('store')->middleware('permission:add_permissions');
        Route::group(['middleware' => 'permission:edit_permissions'], function () {
            Route::get('edit/{permission}', [RoleController::class, 'edit_permissions'])->name('edit');
            Route::put('update/{permission}', [RoleController::class, 'update_permissions'])->name('update');
        });
        Route::delete('delete/{permission}', [RoleController::class, 'delete_permissions'])->name('delete')->middleware('permission:delete_permissions');
    });

    Route::prefix('roles-permissions')->name('admin.roles_permissions.')->group(function () {
        Route::get('/', [RoleController::class, 'all_roles_permissions'])->name('index')->middleware('permission:view_roles_permissions');
        Route::group(['middleware' => 'permission:add_roles_permissions'], function () {
            Route::get('/create', [RoleController::class, 'create_roles_permissions'])->name('create');
            Route::post('store', [RoleController::class, 'store_roles_permissions'])->name('store');
        });
        Route::group(['middleware' => 'permission:edit_roles_permissions'], function () {
            Route::get('edit/{role_permission}', [RoleController::class, 'edit_roles_permissions'])->name('edit');
            Route::put('update/{role_permission}', [RoleController::class, 'update_roles_permissions'])->name('update');
        });
        Route::delete('delete/{role_permission}', [RoleController::class, 'delete_roles_permissions'])->name('delete')->middleware('permission:delete_roles_permissions');
    });

    // Roles And Permissions Routes end here
    Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index')
        ->middleware('permission:view_coupons');
        Route::post('/store', [CouponController::class, 'store'])->name('store')
        ->middleware('permission:create_coupons');
        Route::get('/edit/{coupon}', [CouponController::class, 'edit'])->name('edit')
        ->middleware('permission:edit_coupons');
        Route::put('/update/{coupon}', [CouponController::class, 'update'])->name('update')
        ->middleware('permission:edit_coupons');
        Route::delete('/destroy/{coupon}', [CouponController::class, 'destroy'])->name('delete')
        ->middleware('permission:delete_coupons');
    });


    // Admin Sales Routes end here
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/details/{order}', [SalesController::class, 'details'])->name('detail');   
            Route::post('/update-order-status/{order}', [SalesController::class, 'updateOrderStatus'])->name('update.status');
        });

   
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
