<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <title>{{ $title }}</title>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Shop</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName() === 'home') active @endif"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName() === 'products') active @endif"
                       href="{{ route('products') }}">Products</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() === 'basket') active @endif"
                           href="{{ route('basket') }}"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->getAttribute('username') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                            aria-labelledby="userDropDownMenu">
                            <li>
                                <span class="dropdown-item nav-link py-0">
                                    <a class="nav-link @if (Route::currentRouteName() === 'orders') active @endif"
                                       href="#">Orders</a>
                                </span>
                            </li>
                            <li>
                                <span class="dropdown-item nav-link py-0">
                                    <a class="nav-link @if (Route::currentRouteName() === 'account.details') active @endif"
                                       href="{{ route('account.details') }}">Account</a>
                                </span>

                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item nav-link px-3" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                @guest()
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() === 'login') active @endif"
                           href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() === 'register') active @endif"
                           href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="py-2 mt-auto">
    <div class="container px-4 px-lg-5">
        <p class="m-0 text-center text-white">Copyright &copy; Rafał Kuźmiczuk 2022</p>
    </div>
</footer>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@yield('js')
</body>
</html>
