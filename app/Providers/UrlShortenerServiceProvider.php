<?php

namespace App\Providers;

use App\Contracts\UrlShortenerContract;
use App\Services\UrlShortener;
use Illuminate\Support\ServiceProvider;

class UrlShortenerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UrlShortenerContract::class, UrlShortener::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
