@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
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
                    <h3 class="card-title">Edit Role ({{$role->name}})</h3>
                </div>
                <form action="{{route('role.update', $role->id)}}" method="post">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$role->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" autofocus>
                            @error('name')
                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input class="form-check-input" type="checkbox" value="{{$permission->id}}" name="permissions[]" id="permission-{{$permission->id}}"
                                            @foreach($role->permissions as $role_permission)
                                            {{ $role_permission->id == $permission->id ? 'checked' : '' }}
                                            @endforeach
                                        >
                                        <label for="permission-{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                        <span  class="error text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
