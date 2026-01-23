<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Category::class => CategoryPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('view-reports', fn($admin) => $admin->role === 'admin');
        // $this->registerCategoryGates();       
    }

    protected function registerCategoryGates(): void
    {
        // require app_path('Gates/categoryGate.php');
    }
}
