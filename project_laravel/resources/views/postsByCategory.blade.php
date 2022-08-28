@extends('layouts.app')

@section('content')
    <!-- Page Header Start -->
    <div
        class="container-fluid header-bg py-5 mb-5 wow fadeIn"
        data-wow-delay="0.1s"
    >
        <div class="container py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown">{{$category->name}} Posts</h1>
        </div>
    </div>
    <!-- Page Header End -->

    @foreach($category->posts as $post)
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
                            <i class="far fa-comments text-primary me-3"></i> {{$post->comments_count}} Comment
                        </h5>
                        <h5 class="mb-3">
                            <i class="far fa-user text-primary me-3"></i>
                            {{$post->user && $post->user->name ? $post->user->name : ''}}
                            <small class="text-muted">
                                AT {!! date('d/m/Y H:i A', strtotime($post->created_at)) !!}
                            </small>
                        </h5>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="{{route('singlePost', $post->id)}}">Read More</a>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="img-border">
                            <img class="img-fluid" src="{{$post->attachment_url}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
