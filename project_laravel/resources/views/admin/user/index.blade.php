@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                    <h3 class="card-title">Users ({{$users->total()}})</h3>
                    @can('user.create', Auth::user())
                        <div class="card-tools">
                            <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Create User</a>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge text-capitalize badge-light">{{$role->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('user.update', Auth::user())
                                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('user.delete', Auth::user())
                                            <form id="delete-form-{{$user->id}}" action="{{route('user.destroy', $user->id)}}" method="post" class="d-none">
                                                @method("delete")
                                                @csrf
                                            </form>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                                if (confirm('Are you sure! You want to delete this?')){
                                                   document.getElementById('delete-form-{{$user->id}}').submit()
                                                }"
                                               class="btn btn-sm btn-danger">Delete
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
