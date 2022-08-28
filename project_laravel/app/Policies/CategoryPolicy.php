<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $this->getPermission($user, 'category-view');
    }


    public function view(User $user)
    {
        return $this->getPermission($user, 'category-view');
    }

    public function create(User $user)
    {
        return $this->getPermission($user, 'category-create');
    }


    public function update(User $user)
    {
        return $this->getPermission($user, 'category-update');
    }

    public function delete(User $user)
    {
        return $this->getPermission($user, 'category-delete');
    }


    public function restore(User $user)
    {
        return $this->getPermission($user, 'category-delete');
    }


    public function forceDelete(User $user)
    {
        return $this->getPermission($user, 'category-delete');
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
