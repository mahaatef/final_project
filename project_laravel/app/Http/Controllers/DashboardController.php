<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $roles = Role::count();
        $permissions = Permission::count();
        $users = User::count();
        $categories = Category::count();
        $posts = Post::count();
        $comments = Comment::count();
        return view('admin.home', compact('roles', 'permissions', 'users', 'categories','posts','comments'));
    }
}
