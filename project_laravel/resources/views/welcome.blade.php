@extends('layouts.app')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-dark p-0 mb-5">
        <div class="row g-0 flex-column-reverse flex-lg-row">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    @foreach($popular_posts as $post)
                        <div class="owl-carousel-item">
                            <div class="carousel-caption">
                                <div class="header-bg h-100 d-flex flex-column justify-content-center p-5">
                                    <h1 class="display-4 text-light mb-5">{{$post->title}}</h1>
                                    <div class="d-flex align-items-center pt-4  slideInDown">
                                        <a href="{{route('singlePost', $post->id)}}" class="btn btn-primary py-sm-3 px-3 px-sm-5 me-5">Read More</a>
                                    </div>
                                </div>
                            </div>
                             <img class="img-fluid w-100" style="height: calc(100vh - 75px); min-height: calc(100vh - 75px); object-fit: cover" src="{{$post->attachment_url}}" alt="" /> 
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- random posts Start -->
    <div class="container-xxl pt-5">
        <div class="container">
            <div class="row g-5 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-12">
                    <h1 class="display-5 text-primary mb-0">Random Posts</h1>
                </div>
            </div>
        </div>
    </div>
    @foreach($random_posts as $post)
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
    <!-- random posts End -->

    <!-- Categories Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-12">
                    <h1 class="display-5 mb-0">
                        Special Categories For<br>
                        <span class="text-primary">{{ config('app.name') }}</span> Visitors
                    </h1>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-primary h-100 align-items-center py-4 px-4 px-sm-5">
                            <a href="{{route('postsByCategory', $category->id)}}"><h5 class="mb-0 text-white">{{$category->name}}</h5></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Categories End -->

    <!-- Facts Start -->
    <div class="container-xxl bg-primary facts my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-users fa-3x text-primary mb-3"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">{{$users_count}}</h1>
                    <p class="text-white mb-0">Our Users</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-certificate fa-3x text-primary mb-3"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">{{$categories_count}}</h1>
                    <p class="text-white mb-0">Our Categories</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-sticky-note fa-3x text-primary mb-3"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">{{$posts_count}}</h1>
                    <p class="text-white mb-0">Our Posts News</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-comments fa-3x text-primary mb-3"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">{{$comments_count}}</h1>
                    <p class="text-white mb-0">Our Comments</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

    <!-- Latest Posts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="display-5 text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                Latest Posts
            </h1>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @foreach($latest_posts as $post)
                <div class="testimonial-item text-center">
                    <img class="img-fluid rounded-circle border border-2 p-2 mx-auto mb-4"
                        src="{{$post->attachment_url}}"
                        style="width: 100px; height: 100px; object-fit: cover"
                    />
                    <div class="testimonial-text rounded text-center p-4">
                        <h3>{{$post->title}}</h3>
                        <p style="height:100px; overflow: hidden">{{$post->content}}</p>
                        <h5>
                            <i class="far fa-user text-primary me-1"></i>
                            {{$post->user && $post->user->name ? $post->user->name : ''}}
                            <small class="text-muted">
                                AT {!! date('d/m/Y H:i A', strtotime($post->created_at)) !!}
                            </small>
                        </h5>
                        <a href="{{route('singlePost', $post->id)}}" class="fst-italic">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest Posts  End -->
@endsection
