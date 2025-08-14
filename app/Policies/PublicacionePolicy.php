<?php

namespace App\Policies;

use App\Models\Publicacione;
use App\Models\User;

class PublicacionePolicy
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
        if ($user->permissions->contains('slug', 'publicacione-lista')) {
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
        if ($user->permissions->contains('slug', 'publicacione-crear')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nota  $nota
     * @return mixed
     */
    public function update(User $user, Publicacione $publicacione)
    {
        if ($user->permissions->contains('slug', 'publicacione-editar')) {
            return true;
        }
    }
    public function delete(User $user, Publicacione $publicacione)
    {
        if ($user->permissions->contains('slug', 'publicacione-eliminar')) {
            return true;
        }
    }
}
