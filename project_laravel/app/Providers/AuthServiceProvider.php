<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('role', 'App\Policies\RolePolicy');
        Gate::resource('permission', 'App\Policies\PermissionPolicy');
        Gate::resource('user', 'App\Policies\UserPolicy');
        Gate::resource('category', 'App\Policies\CategoryPolicy');
        Gate::resource('post', 'App\Policies\PostPolicy');
        Gate::resource('comment', 'App\Policies\CommentPolicy');
        Gate::define('comment.filter', 'App\Policies\CommentPolicy@filter');
    }
}
