@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
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
                    <h3 class="card-title">Permissions ({{$permissions->total()}})</h3>
                    @can('permission.create', Auth::user())
                        <div class="card-tools">
                            <a href="{{route('permission.create')}}" class="btn btn-sm btn-primary">Create Permission</a>
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
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>
                                        @can('permission.update', Auth::user())
                                            <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('permission.delete', Auth::user())
                                            <form id="delete-form-{{$permission->id}}" action="{{route('permission.destroy', $permission->id)}}" method="post" class="d-none">
                                                @method("delete")
                                                @csrf
                                            </form>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                                if (confirm('Are you sure! You want to delete this?')){
                                                   document.getElementById('delete-form-{{$permission->id}}').submit()
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
                    {!! $permissions->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
