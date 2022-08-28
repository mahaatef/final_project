@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Comments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Comments</li>
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
                    <h3 class="card-title">Comments ({{$comments->total()}})</h3>
                    @can('comment.create', Auth::user())
                        <div class="card-tools">
                            <a href="{{route('comment.create')}}" class="btn btn-sm btn-primary">Create Comment</a>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @can('comment.filter', Auth::user())
                        <form action="{{route('comment.index')}}" method="get" >
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">User</label>
                                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user">
                                            <option value="">Choose user</option>
                                            @foreach($users as $user)
                                                <option @if(request()->get('user_id') == $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category">
                                            <option value="">Choose Category</option>
                                            @foreach($categories as $category)
                                                <option @if(request()->get('category_id') == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="post">Post</label>
                                        <select name="post_id" class="form-control @error('post_id') is-invalid @enderror" id="post">
                                            <option value="">Choose Post</option>
                                        </select>
                                        @error('post_id')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from">From</label>
                                        <input name="from" value="{{request()->get('from')}}" type="date" class="form-control @error('from') is-invalid @enderror" id="from">
                                        @error('from')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="to">To</label>
                                        <input name="to" type="date" value="{{request()->get('to')}}" class="form-control @error('to') is-invalid @enderror" id="to">
                                        @error('to')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    @if (request()->hasAny('user_id', 'category_id', 'post_id', 'from', 'to'))
                                        <a href="{{route('comment.index')}}" class="btn btn-warning">Clear Filter</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    @endcan
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Content</th>
                                <th style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->post}}</td>
                                    <td>{{$comment->category}}</td>
                                    <td>{{$comment->user}}</td>
                                    <td>{{$comment->content}}</td>
                                    <td>
                                        @can('comment.update', Auth::user())
                                            <a href="{{route('comment.edit',$comment->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('comment.delete', Auth::user())
                                            <form id="delete-form-{{$comment->id}}" action="{{route('comment.destroy', $comment->id)}}" method="post" class="d-none">
                                                @method("delete")
                                                @csrf
                                            </form>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                                if (confirm('Are you sure! You want to delete this?')){
                                                   document.getElementById('delete-form-{{$comment->id}}').submit()
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
                    {!! $comments->withQueryString()->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let route = "{{ route('category.posts') }}";
        let token = "{{ csrf_token()}}";
        $("#category").change(function () {
            const category = this.value;
            $.ajax({
                url: route,
                type: 'GET',
                data: {
                    _token:token,
                    category:category,
                },
                success: function(response) {
                    $("#post").html(response);
                },
                error: function(xhr) {
                    // Something to handle error
                }
            });
        });
    </script>
@endsection
