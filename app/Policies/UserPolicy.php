<?php

namespace busRegistration\Policies;

use busRegistration\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \busRegistration\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-user']);
    }
    /**
     * Determine whether the user can update the user.
     *
     * @param  \busRegistration\User  $user
     * @return mixed
     */
    public function update(User $user, $id = null)
    {
        if(! is_null($id)) {
            if ($user->id === $id->id) {
                return true;
            }
        }
        return $user->hasAccess(['update-user']);
    }
}
