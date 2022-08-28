<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $this->getPermission($user, 'comment-view');
    }


    public function view(User $user)
    {
        return $this->getPermission($user, 'comment-view');
    }

    public function create(User $user)
    {
        return $this->getPermission($user, 'comment-create');
    }


    public function update(User $user)
    {
        return $this->getPermission($user, 'comment-update');
    }

    public function delete(User $user)
    {
        return $this->getPermission($user, 'comment-delete');
    }


    public function restore(User $user)
    {
        return $this->getPermission($user, 'comment-delete');
    }


    public function forceDelete(User $user)
    {
        return $this->getPermission($user, 'comment-delete');
    }

    public function filter(User $user)
    {
        return $this->getPermission($user, 'comment-filter');
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
