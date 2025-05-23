<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Store</title>

    <!-- Bootstrap + FontAwesome + Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #e3f2fd;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.3rem;
        }
        .nav-link {
            color: #333;
            font-weight: 500;
            margin-left: 1rem;
        }
        .nav-link:hover {
            color: #0d6efd;
            text-decoration: underline;
        }
        .dropdown-menu a {
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="fas fa-book me-2 text-primary"></i>Library Store
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.search') }}">All Books</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome {{ Auth::user()->name }} 
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.mypage.current') }}"><i class="fas fa-user-circle me-2"></i>My Page</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">

            <div class="col-md-3 mb-4">
                <h5 class="text-warning">Navigation</h5>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="{{ route('books.search') }}" class="text-light text-decoration-none">All Books</a></li>
                    @auth
                        <li><a href="{{ route('user.mypage.current') }}" class="text-light text-decoration-none">My Page</a></li>
                        @if(Auth::user()->is_admin ?? false || Auth::guard('admin')->check())
                            <li><a href="{{ route('admin.dashboard') }}" class="text-light text-decoration-none">Admin</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

            <!-- Suport -->
            <div class="col-md-3 mb-4">
                <h5 class="text-warning">Support</h5>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-light text-decoration-none">Terms of Service</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Policy</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Contact us</a></li>
                </ul>
            </div>

            <!-- Information -->
            <div class="col-md-3 mb-4">
                <h5 class="text-warning">About</h5>
                <p class="small mb-1">Library Store Inc.</p>
                <p class="small mb-1">Osaka, Japan</p>
                <p class="small mb-0">hello@library-store.jp</p>
            </div>

            <!-- SNS -->
            <div class="col-md-3 mb-4">
                <h5 class="text-warning">Connect</h5>
                <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github"></i></a>
                <a href="#" class="text-light fs-5 me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light fs-5 me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-light fs-5 me-3"><i class="fab fa-youtube"></i></a>
                <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram"></i></a>

            </div>
        </div>

        <hr class="border-top border-light">
        <div class="text-center small mt-3">
            © 2025 Library Store. All rights reserved.
        </div>
    </div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

</body>
</html>
