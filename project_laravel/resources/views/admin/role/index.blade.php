@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                    <h3 class="card-title">Roles ({{$roles->total()}})</h3>
                    @can('role.create', Auth::user())
                        <div class="card-tools">
                            <a href="{{route('role.create')}}" class="btn btn-sm btn-primary">Create Role</a>
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
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @can('role.update', Auth::user())
                                            <a href="{{route('role.edit',$role->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('role.delete', Auth::user())
                                            <form id="delete-form-{{$role->id}}" action="{{route('role.destroy', $role->id)}}" method="post" class="d-none">
                                                @method("delete")
                                                @csrf
                                            </form>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                                if (confirm('Are you sure! You want to delete this?')){
                                                   document.getElementById('delete-form-{{$role->id}}').submit()
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
                    {!! $roles->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
