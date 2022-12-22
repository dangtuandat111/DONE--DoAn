<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Server\Entities\Model\Customer;
use Packages\Server\Repository\Admin\CustomerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
