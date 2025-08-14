<?php

namespace App\Policies;

use App\Models\Aviso;
use App\Models\User;

class AvisoPolicy
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
        if ($user->permissions->contains('slug', 'aviso-lista')) {
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
        if ($user->permissions->contains('slug', 'aviso-crear')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aviso  $aviso
     * @return mixed
     */
    public function update(User $user, Aviso $aviso)
    {
        if ($user->permissions->contains('slug', 'aviso-editar')) {
            return true;
        }
    }
    public function delete(User $user, Aviso $aviso)
    {
        if ($user->permissions->contains('slug', 'aviso-eliminar')) {
            return true;
        }
    }
}
