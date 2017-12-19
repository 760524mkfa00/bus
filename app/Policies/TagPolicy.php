<?php

namespace busRegistration\Policies;

use busRegistration\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
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
     * Determine whether the user can create a role.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess(['list-tag']);
    }
    /**
     * Determine whether the user can create a role.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-tag']);
    }

    /**
     * Determine whether the user can create a role.
     *
     * @param User $user
     * @return bool
     */
    public function store(User $user)
    {
        return $user->hasAccess(['store-tag']);
    }

    /**
     * Determine whether the user can remove a role.
     *
     * @param User $user
     * @return bool
     */
    public function remove(User $user)
    {
        return $user->hasAccess(['remove-tag']);
    }
}
