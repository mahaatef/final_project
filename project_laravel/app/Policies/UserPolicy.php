<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $this->getPermission($user, 'user-view');
    }


    public function view(User $user)
    {
        return $this->getPermission($user, 'user-view');
    }

    public function create(User $user)
    {
        return $this->getPermission($user, 'user-create');
    }


    public function update(User $user)
    {
        return $this->getPermission($user, 'user-update');
    }

    public function delete(User $user)
    {
        return $this->getPermission($user, 'user-delete');
    }


    public function restore(User $user)
    {
        return $this->getPermission($user, 'user-delete');
    }


    public function forceDelete(User $user)
    {
        return $this->getPermission($user, 'user-delete');
    }

    protected function getPermission($user, $p_n){
        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                if ($permission->name == $p_n){
                    return true;
                }
            }
        }
        return false;
    }
}
