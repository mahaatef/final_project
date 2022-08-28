<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user.view')->only('index');
        $this->middleware('can:user.create')->only('create');
        $this->middleware('can:user.update')->only('edit');
        $this->middleware('can:user.delete')->only('destroy');
    }

    public function index()
    {
        $users = User::orderByDesc('id')->paginate('10');
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);
        $user->roles()->sync($request->roles);
        return redirect(route('user.index'));
    }


    public function show(User $user)
    {
        return redirect(route('user.index'));
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
        ]);
        if (isset($request->password)){
            $user->update(['password'=> bcrypt($request->password)]);
        }
        $user->roles()->sync($request->roles);
        return redirect(route('user.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
