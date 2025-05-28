<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DomPdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('dompdf', function () {
            return new \Dompdf\Dompdf(config('dompdf.options'));
        });

        $this->app->bind('dompdf.wrapper', function ($app) {
            return new \Barryvdh\DomPDF\PDF($app['dompdf'], $app['config'], $app['files'], $app['view']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
