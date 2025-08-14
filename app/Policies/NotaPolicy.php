<?php

namespace App\Policies;

use App\Models\Nota;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotaPolicy
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
        if ($user->permissions->contains('slug', 'nota-lista')) {
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
        if ($user->permissions->contains('slug', 'nota-crear')) {
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
    public function update(User $user, Nota $nota)
    {
        if ($user->permissions->contains('slug', 'nota-editar')) {
            return true;
        }
    }
    public function delete(User $user, Nota $nota)
    {
        if ($user->permissions->contains('slug', 'nota-eliminar')) {
            return true;
        }
    }
}
