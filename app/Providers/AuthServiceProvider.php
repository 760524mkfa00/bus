<?php

namespace busRegistration\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'busRegistration\User' => 'busRegistration\Policies\UserPolicy',
        'busRegistration\Role' => 'busRegistration\Policies\RolePolicy',
        'busRegistration\School' => 'busRegistration\Policies\SchoolPolicy',
        'busRegistration\Grade' => 'busRegistration\Policies\GradePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
