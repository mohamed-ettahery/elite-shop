<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::share([
            'site_name' => 'Online Shop',
            'site_link' => '/',
            'site_mail' => 'shop@online.com',
            'site_phone' => '+212 55667788',
            'site_address' => 'BD 22, Casablanca, Maroc',
        ]);
    }
}
