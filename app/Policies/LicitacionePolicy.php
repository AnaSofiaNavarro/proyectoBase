<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Licitacione;

class LicitacionePolicy
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
        if ($user->permissions->contains('slug', 'licitacion-lista')) {
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
        if ($user->permissions->contains('slug', 'licitacion-crear')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Legislacion  $nota
     * @return mixed
     */
    public function update(User $user, Licitacione $legislacion)
    {
        if ($user->permissions->contains('slug', 'licitacion-editar')) {
            return true;
        }
    }
    public function delete(User $user, Licitacione $legislacion)
    {
        if ($user->permissions->contains('slug', 'licitacion-eliminar')) {
            return true;
        }
    }
}
