@extends('layouts.app')

@section('content')
    <!-- Page Header Start -->
    <div
        class="container-fluid header-bg py-5 mb-5 wow fadeIn"
        data-wow-delay="0.1s"
    >
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">{{$post->title}}</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-4">
                        {{$post->title}}
                    </h1>
                    <p class="mb-4">
                        {{$post->content}}
                    </p>
                    <h5 class="mb-3">
                        <i class="fas fa-certificate text-primary me-3"></i> {{$post->category && $post->category->name ? $post->category->name : '' }}
                    </h5>
                    <h5 class="mb-3">
                        <i class="far fa-user text-primary me-3"></i>
                        {{$post->user && $post->user->name ? $post->user->name : ''}}
                        <small class="text-muted">
                            AT {!! date('d/m/Y H:i A', strtotime($post->created_at)) !!}
                        </small>
                    </h5>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="img-border">
                        <img class="img-fluid" src="{{$post->attachment_url}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Comments Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <form method="post" action="{{route('addPostComment', $post->id)}}">
                    @csrf
                    <div class="form-floating mb-3">
                        <textarea name="content" class="form-control bg-light border-0" placeholder="Leave a comment here" id="comment" style="height: 100px">{{old('content')}}</textarea>
                        <label for="comment">Leave a comment here</label>
                    </div>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <button class="btn btn-primary py-3" type="submit">
                        Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Comments End -->

    <!-- Comments Start -->
    <div class="container-xxl py-5">
        <div class="container">
            @foreach($post->comments as $comment)
                <div class="wow fadeInUp mb-5" data-wow-delay="0.1s">
                    <h5 class="mb-1">{{$comment->user && $comment->user->name ? $comment->user->name : ''}}</h5>
                    <p class="mb-0">{{$comment->content}}</p>
                    <small class="text-muted">
                        AT {!! date('d/m/Y H:i A', strtotime($comment->created_at)) !!}
                    </small>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Comments End -->
@endsection
