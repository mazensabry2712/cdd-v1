<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
  
    public function register()
{
    $this->app->singleton(\App\Services\PdfService::class, function ($app) {
        return new \App\Services\PdfService();
    });
}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
