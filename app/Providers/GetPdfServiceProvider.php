<?php

namespace App\Providers;

use App\Http\Services\GetPdfService;
use App\Http\Services\GetPdfServiceInterface;
use Illuminate\Support\ServiceProvider;

class GetPdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetPdfServiceInterface::class, GetPdfService::class);
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
