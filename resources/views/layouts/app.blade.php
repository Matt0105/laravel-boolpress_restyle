<!doctype html>
<html class="guest-document" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/front.js') }}" defer></script> --}}
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body @auth class="bg-secondary" @endauth>
    {{-- <div id="app"> --}}
        {{-- @dd(str_contains(Route::currentRouteName(), 'admin.categories')) --}}
        <nav class="page-navbar">
            
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="logo-container">
                    <img class="logo-img" src="{{asset('images/boolpress-logo.png')}}" alt="">
                </div>
                <span class="logo-name">{{ config('app.name', 'Laravel') }}</span>
            </a>
                

            <div class="account-actions" id="navbarSupportedContent">
                
                <!-- Right Side Of Navbar -->
                <ul class="login-register-list">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="label" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="label" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item">
                        <a id="navbarDropdown" class="navbar-userName" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                        <li>
                            <div aria-labelledby="navbarDropdown">
                                <a class="label" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        
                        
                    @endguest
                </ul>
            </div>
            
        </nav>

        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    {{-- </div> --}}
</body>
</html>
