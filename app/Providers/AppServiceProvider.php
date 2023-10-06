<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryInterface;
use App\Repositories\SubcategoryRepository;
use App\Repositories\Interfaces\SubcategoryInterface;
use App\Repositories\Interfaces\ProducttypeInterface;
use App\Repositories\ProducttypeRepository;
use App\Repositories\WishlistRepository;
use App\Repositories\Interfaces\WishlistInterface;
use App\Repositories\Interfaces\SwapInterface;
use App\Repositories\SwapRepository;
use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\ProductRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubcategoryInterface::class, SubcategoryRepository::class);

        $this->app->bind(ProducttypeInterface::class, ProducttypeRepository::class);
        $this->app->bind(WishlistInterface::class,  WishlistRepository::class);
        $this->app->bind(SwapInterface::class,  SwapRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);

    }




    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
