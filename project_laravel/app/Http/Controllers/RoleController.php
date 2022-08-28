<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:role.view')->only('index');
        $this->middleware('can:role.create')->only('create');
        $this->middleware('can:role.update')->only('edit');
        $this->middleware('can:role.delete')->only('destroy');
    }

    public function index()
    {
        $roles = Role::orderByDesc('id')->paginate('10');
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name'=> $request->name
        ]);
        $role->permissions()->sync($request->permissions);
        return redirect(route('role.index'));
    }


    public function show(Role $role)
    {
        return redirect(route('role.index'));
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name'=> $request->name
        ]);
        $role->permissions()->sync($request->permissions);
        return redirect(route('role.index'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back();
    }
}
