@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
    <div class="row">
        @can('role.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$roles}} <small>Roles</small></h3>
                    </div>
                    <a href="{{route('role.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('permission.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$permissions}} <small>Permissions</small></h3>
                    </div>
                    <a href="{{route('permission.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('user.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-warning">
                    <div class="inner">
                        <h3>{{$users}} <small>Users</small></h3>
                    </div>
                    <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('category.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-danger">
                    <div class="inner">
                        <h3>{{$categories}} <small>Categories</small></h3>
                    </div>
                    <a href="{{route('category.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('post.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-primary">
                    <div class="inner">
                        <h3>{{$posts}} <small>Posts</small></h3>
                    </div>
                    <a href="{{route('post.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('comment.view', Auth::user())
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-dark">
                    <div class="inner">
                        <h3>{{$comments}} <small>Comments</small></h3>
                    </div>
                    <a href="{{route('comment.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
    </div>
@endsection
