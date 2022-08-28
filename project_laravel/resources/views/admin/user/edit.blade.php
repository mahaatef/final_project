@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit User ({{$user->name}})</h3>
                </div>
                <form action="{{route('user.update', $user->id)}}" method="post">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" autofocus>
                                    @error('name')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email">
                                    @error('email')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
                                    @error('password')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Enter password confirmation">
                                    @error('password_confirmation')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-3">
                                            <div class="icheck-primary">
                                                <input class="form-check-input" type="checkbox" value="{{$role->id}}" name="roles[]" id="role-{{$role->id}}"
                                                @foreach($user->roles as $role_user)
                                                    {{ $role_user->id == $role->id ? 'checked' : '' }}
                                                    @endforeach
                                                >
                                                <label for="role-{{$role->id}}">
                                                    {{$role->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                <span  class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
