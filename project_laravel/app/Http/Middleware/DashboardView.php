<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardView
{

    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user){
            $user = $user->id;
            $permission = DB::table('permissions')
                ->join('permission_role', 'permissions.id','permission_role.permission_id')
                ->join('roles', 'roles.id','permission_role.role_id')
                ->join('user_role', 'roles.id','user_role.role_id')
                ->where('user_role.user_id', $user)
                ->where('permissions.name', 'dashboard-view')
                ->select('permissions.name as permission')->first();
            if ($permission){
                return $next($request);
            }else{
                return redirect(route('home'));
            }
        }else{
            return redirect(route('home'));
        }

    }
}
