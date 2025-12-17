<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $data['categories'] = Category::where(['status' => 1, 'parent_id' => null])
                ->with('subcategories')
                ->get();
            $data['brands'] = Brand::where(['status' => 1])->get();

            // Cart (guest OR user)
            if (Auth::check()) {
                $data['cartData'] = Cart::with('items')
                    ->where('user_id', Auth::id())
                    ->first();
            } else {
                $data['cartData'] = Cart::with('items')
                    ->where('session_id', Session::getId())
                    ->first();
            }
            // Cart (guest OR user)


            $view->with($data);
        });
    }
}
