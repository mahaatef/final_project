<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap"
        rel="stylesheet"
    />
    <!-- Icon Font Stylesheet -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
</head>

<body>
<!-- Spinner Start -->
<div
    id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
>
    <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem"
        role="status"
    >
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->
{{--back-to-top--}}
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style=""><i class="bi bi-arrow-up"></i></a>
{{--end back-to-top--}}
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a class="navbar-brand p-0" href="{{ url('/') }}">
        <h1 class="m-0 text-primary">{{ config('app.name', 'Laravel') }}</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
            <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>

            @php $categories = \App\Models\Category::limit(5)->get(); @endphp
            @foreach($categories as $category)
                <a class="nav-item nav-link" href="{{route('postsByCategory', $category->id)}}">{{$category->name}}</a>
            @endforeach

            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>
        @guest
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-primary">Login<i class="fa fa-arrow-right ms-3"></i></a>
            @endif
        @endguest
    </div>
</nav>
<!-- Navbar End -->

    @yield('content')


<!-- Footer Start -->
<div class="container-fluid footer bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="text-light mb-4">Address</h5>
                <p class="mb-2">
                    <i class="fa fa-map-marker-alt me-3"></i>Address Here
                </p>
                <p class="mb-2">
                    <i class="fa fa-phone-alt me-3"></i>+012 345 67890
                </p>
                <p class="mb-2">
                    <i class="fa fa-envelope me-3"></i>info@example.com
                </p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="text-light mb-4">Quick Links</h5>
                <a class="btn btn-link" href="{{route('home')}}">Home</a>
                @foreach($categories as $category)
                    <a class="btn btn-link" href="{{route('postsByCategory', $category->id)}}">{{$category->name}}</a>
                @endforeach
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">{{ config('app.name') }}</h5>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-12 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="">{{ config('app.name') }}</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
