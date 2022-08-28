<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permission.view')->only('index');
        $this->middleware('can:permission.create')->only('create');
        $this->middleware('can:permission.update')->only('edit');
        $this->middleware('can:permission.delete')->only('destroy');
    }
    public function index()
    {
        $permissions = Permission::orderByDesc('id')->paginate('10');
        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        Permission::create([
            'name'=> $request->name
        ]);

        return redirect(route('permission.index'));
    }


    public function show(Role $role)
    {
        return redirect(route('permission.index'));
    }


    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }


    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name'=> $request->name
        ]);

        return redirect(route('permission.index'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back();
    }
}
