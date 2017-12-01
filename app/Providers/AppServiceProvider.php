<?php

namespace busRegistration\Providers;

use busRegistration\Role;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \View::composer('*', function($view) {
            $roles = \Cache::rememberForever('roles', function() {
                return Role::all();
            });
            $view->with('roles', array_pluck($roles, 'name', 'id'));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
