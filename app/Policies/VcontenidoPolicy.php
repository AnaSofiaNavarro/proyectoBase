<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vcontenido;
use Illuminate\Auth\Access\HandlesAuthorization;

class VcontenidoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isAdmin()){
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
        if($user->permissions->contains('slug', 'contenido-lista'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vcontenido  $vcontenido
     * @return mixed
     */
    public function view(User $user, Vcontenido $vcontenido)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->permissions->contains('slug', 'contenido-crear'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vcontenido  $vcontenido
     * @return mixed
     */
    public function update(User $user, Vcontenido $vcontenido)
    {
        if($user->permissions->contains('slug', 'contenido-editar'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vcontenido  $vcontenido
     * @return mixed
     */
    public function delete(User $user, Vcontenido $vcontenido)
    {
        if($user->permissions->contains('slug', 'contenido-eliminar'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vcontenido  $vcontenido
     * @return mixed
     */
    public function restore(User $user, Vcontenido $vcontenido)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vcontenido  $vcontenido
     * @return mixed
     */
    public function forceDelete(User $user, Vcontenido $vcontenido)
    {
        //
    }
}
