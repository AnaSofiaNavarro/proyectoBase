<?php

namespace App\Policies;

use App\Models\Configuracion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfiguracionPolicy
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
        if($user->permissions->contains('slug','configuracion-lista'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuracion  $configuracion
     * @return mixed
     */
    public function view(User $user, Configuracion $configuracion)
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
        if($user->permissions->contains('slug','configuracion-crear'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuracion  $configuracion
     * @return mixed
     */
    public function update(User $user, Configuracion $configuracion)
    {
        if($user->permissions->contains('slug','configuracion-editar'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuracion  $configuracion
     * @return mixed
     */
    public function delete(User $user, Configuracion $configuracion)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuracion  $configuracion
     * @return mixed
     */
    public function restore(User $user, Configuracion $configuracion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuracion  $configuracion
     * @return mixed
     */
    public function forceDelete(User $user, Configuracion $configuracion)
    {
        //
    }
}
