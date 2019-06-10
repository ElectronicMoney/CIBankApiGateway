<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return Auth::id() === $user->id;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::id() === $user->id;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return Auth::id() === $user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return Auth::id() === $user->id;
    }
}
