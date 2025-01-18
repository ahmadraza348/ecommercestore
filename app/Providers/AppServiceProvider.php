<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Brand;
use App\Models\Category;

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
                $data['brands'] = Brand::where(['status'=>1])->get();
            $view->with($data);
        });
    }
}
