<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $this->getPermission($user, 'post-view');
    }


    public function view(User $user)
    {
        return $this->getPermission($user, 'post-view');
    }

    public function create(User $user)
    {
        return $this->getPermission($user, 'post-create');
    }


    public function update(User $user)
    {
        return $this->getPermission($user, 'post-update');
    }

    public function delete(User $user)
    {
        return $this->getPermission($user, 'post-delete');
    }


    public function restore(User $user)
    {
        return $this->getPermission($user, 'post-delete');
    }


    public function forceDelete(User $user)
    {
        return $this->getPermission($user, 'post-delete');
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
