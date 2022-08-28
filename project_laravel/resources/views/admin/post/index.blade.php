@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Posts</li>
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
                    <h3 class="card-title">Posts ({{$posts->total()}})</h3>
                    @can('post.create', Auth::user())
                        <div class="card-tools">
                            <a href="{{route('post.create')}}" class="btn btn-sm btn-primary">Create Post</a>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 150px;">Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>User</th>
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>
                                        @if($post->attachment)
                                            <img src="{{$post->attachment_url}}" class="img-thumbnail" style="max-height: 50px; max-width: 50px" alt="">
                                        @endif
                                        {{$post->title}}
                                    </td>
                                    <td>{{$post->content}}</td>
                                    <td>{{$post->category ? $post->category->name : ""}}</td>
                                    <td>{{$post->user ? $post->user->name : ""}}</td>
                                    <td>
                                        @can('post.update', Auth::user())
                                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('post.delete', Auth::user())
                                            <form id="delete-form-{{$post->id}}" action="{{route('post.destroy', $post->id)}}" method="post" class="d-none">
                                                @method("delete")
                                                @csrf
                                            </form>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                                if (confirm('Are you sure! You want to delete this?')){
                                                   document.getElementById('delete-form-{{$post->id}}').submit()
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
                    {!! $posts->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
