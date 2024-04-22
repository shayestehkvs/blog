<?php

namespace App\Providers;

use App\Repositories\IProductRepo;
use App\Repositories\ProductRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IProductRepo::class, ProductRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
