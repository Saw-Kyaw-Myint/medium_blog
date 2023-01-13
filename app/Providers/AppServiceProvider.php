<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
               //Dao Registeration
               $this->app->bind('App\Contracts\Dao\Auth\AuthDaoInterface', 'App\Dao\Auth\AuthDao');
               $this->app->bind('App\Contracts\Dao\Auth\ForgotDaoInterface', 'App\Dao\Auth\ForgotDao');

               //Business Logic Registeration
               $this->app->bind('App\Contracts\Services\Auth\AuthServiceInterface', 'App\Services\Auth\AuthService');
               $this->app->bind('App\Contracts\Services\Auth\ForgotServiceInterface', 'App\Services\Auth\ForgotService');

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
