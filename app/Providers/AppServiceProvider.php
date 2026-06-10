<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Models\Bencana;
use App\Observers\BencanaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Bencana::observe(BencanaObserver::class);
    }
    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     Paginator::useBootstrapFive();
        
    //     // Register middlewares
    //     Route::aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
    //     Route::aliasMiddleware('role', \App\Http\Middleware\RoleAccess::class);
        
    // }
}
