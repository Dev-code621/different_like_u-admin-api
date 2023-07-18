<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\RolesTrait;

class ReplyPolicy
{
    use HandlesAuthorization;
    use RolesTrait;

    /**
     * Determine whether the user can view
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return RolesTrait::hasRoles(['AdminPanel'], $user->getRoleNames()->toArray());
    }

    /**
     * Determine whether the user can view
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return RolesTrait::hasRoles(['AdminPanel'], $user->getRoleNames()->toArray());
    }

    public function update(User $user)
    {
        return RolesTrait::hasRoles(['AdminPanel'], $user->getRoleNames()->toArray());
    }

}