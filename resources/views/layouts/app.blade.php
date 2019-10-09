<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MOT Archive') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if(Auth::user())
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MOT Archives') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/letter">
                                    {{ __('Letters') }}
                                    @if(Auth::user()->newLettersCount() > 0)
                                    <span class="badge badge-pill badge-danger">{{Auth::user()->newLettersCount()}}</span>
                                    @endif
                                </a>
                            
                            </li>
                            @if(Auth::user()->role_id() == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="/letter/create">{{ 'Add letter'}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Users') }}">{{ __('Users') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/images/{{(Auth::user()->profile_pic == null)?'avatar-male.png':Auth::user()->profile_pic}}" alt="profile_pic" 
                                    style="width:30px;height:30px; border-radius: 50%; margin: auto" class="img-circle"> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right  justify-content-center " style="text-align: center" aria-labelledby="navbarDropdown">
                                    <img src="/images/{{(Auth::user()->profile_pic == null)?'avatar-male.png':Auth::user()->profile_pic}}" alt="profile_pic" 
                                        style="width:100px;height:100px; border-radius: 50%" class="img-circle">
                                    <h4>{{Auth::user()->first_name}} {{Auth::user()->father_name}}</h4>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
