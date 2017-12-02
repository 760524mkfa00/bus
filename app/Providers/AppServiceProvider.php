<?php

namespace busRegistration\Providers;

use busRegistration\Grade;
use busRegistration\Role;
use busRegistration\School;
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

        \View::composer('*', function($view) {
            $schools = \Cache::rememberForever('schools', function() {
                return School::all();
            });
            $view->with('schools', array_pluck($schools, 'school', 'id'));
        });

        \View::composer('*', function($view) {
            $grades = \Cache::rememberForever('grades', function() {
                return Grade::all();
            });
            $view->with('grades', array_pluck($grades, 'grade', 'id'));
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
