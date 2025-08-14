<?php

namespace App\Policies;

use App\Models\Amparo;
use App\Models\User;

class amparoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->permissions->contains('slug', 'amparo-lista')) {
            return true;
        }
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->permissions->contains('slug', 'amparo-crear')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Amparo  $amparo
     * @return mixed
     */
    public function update(User $user, Amparo $amparo)
    {
        if ($user->permissions->contains('slug', 'amparo-editar')) {
            return true;
        }
    }
    public function delete(User $user, Amparo $amparo)
    {
        if ($user->permissions->contains('slug', 'amparo-eliminar')) {
            return true;
        }
    }
}
