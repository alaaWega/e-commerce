<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from laravelecommerceexample.ca/cart by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jun 2020 21:16:39 GMT -->
    <!-- Added by HTTrack --><meta
        http-equiv="content-type"
        content="text/html;charset=UTF-8"
    /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta
            name="csrf-token"
            content="nvggLkr4XriuW6x32myBjszYdQox8Hbu2QMoh7BR"
        />

        <title>Laravel Ecommerce | @yield('title')</title>

        <link href="img/favicon.html" rel="SHORTCUT ICON" />

        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700"
            rel="stylesheet"
        />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/assets/css/app.css')}}" />
        <link rel="stylesheet" href="{{ asset('/assets/css/responsive.css')}}" />

        @yield('styles')
    </head>

    <body class="@yield('body-class', '')">
        <header>
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo"><a href="{{ url('/') }}">Ecommerce</a></div>
                    @if(!request()->is('checkout'))
                    <ul>
                        <li>
                            <a href="{{ url('shop') }}">
                                Shop
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="https://blog.laravelecommerceexample.ca/">
                                Blog
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
                <div class="top-nav-right">
                    @if(!request()->is('checkout'))
                    <ul>
                        @guest
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                        </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                        <li><a href="{{ url('cart') }}">Cart </a>
                            @if (isset($cartCount) && $cartCount)
                            <span class="cart-count"><span>{{ $cartCount }}</span></span>
                            @endif
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
            <!-- end top-nav -->
        </header>

        @yield('content')

        @include('partials.footer')

        @include('partials.scripts')

        @yield('extra-js')

    </body>

    <!-- Mirrored from laravelecommerceexample.ca/cart by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jun 2020 21:16:42 GMT -->
</html>
