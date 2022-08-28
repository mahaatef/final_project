@extends('admin.layouts.app')

<!-- Content Header (Page header) -->
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Comment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('comment.index')}}">Comments</a></li>
                        <li class="breadcrumb-item active">Create Comment</li>
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
                    <h3 class="card-title">Create Comment</h3>
                </div>
                <form action="{{route('comment.store')}}" method="post" >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category">
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                            <option @if(old('category_id') == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea rows="5" name="content" class="form-control @error('content') is-invalid @enderror" id="content" placeholder="Enter Content">{{old('content')}}</textarea>
                                    @error('content')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Comment</button>
                    </div>
                </form>
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

