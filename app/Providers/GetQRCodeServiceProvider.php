<?php

namespace App\Providers;

use App\Http\Services\GetQRCodeService;
use App\Http\Services\GetQRCodeServiceInterface;
use Illuminate\Support\ServiceProvider;

class GetQRCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetQRCodeServiceInterface::class, GetQRCodeService::class);
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
