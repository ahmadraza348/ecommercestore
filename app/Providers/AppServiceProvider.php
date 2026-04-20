<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      // Stripe SDK ko register karna taake API key hamesha set rahe
        $this->app->singleton(StripeClient::class, function ($app) {
            return new StripeClient(config('services.stripe.secret'));
        });
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $data['categories'] = Category::where(['status' => 1, 'parent_id' => null])
                ->with('subcategories')
                ->get();
            $data['brands'] = Brand::where(['status' => 1])->get();


            if (Auth::check()) {
                $data['cartData'] = Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
                    ->where('user_id', Auth::id())
                    ->first();
            } else {
                $data['cartData'] = Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
                    ->where('session_id', Session::getId())
                    ->first();
            }
            // dd($data['cartData']);

            $view->with($data);
        });
    }
}
