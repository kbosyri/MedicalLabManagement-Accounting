<?php

namespace App\Providers;

use App\GetBalance\GetBalance;
use Illuminate\Support\ServiceProvider;

class GetBalanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('GetBalance',function(){
            return new GetBalance();
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
