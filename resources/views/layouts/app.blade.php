<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'St. Louis Pickup Soccer') }}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="slicker/slick/slick.css" > 
        <link rel="stylesheet" type="text/css" href="slicker/slick/slick-theme.css" >
        <link rel='stylesheet' type='text/css' href="{{asset('css/custom.css')}}?v={{env('CSS_V')}}" >
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top" >
                <div class="container">
                    <div class="navbar-header" > 
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed menuu" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button> 
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'St. Louis Pickup Soccer') }}
                        </a>
                    </div> 

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                       

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <a href="{{ route('login') }}"><button class="btn btn-primary">Login</button></a>
                            <a href="{{ route('register') }}"><button class="btn btn-success">Signup</button></a>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('my_account') }}">
                                            My Account
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
            @yield('image_upload') 
        </div>
        <!-- Scripts -->
        @yield('locations')


        <script src="{{ asset('js/app.js') }}"></script>  
        <script type="text/javascript" src="slicker/slick/slick.min.js"></script>
    </body> 
</html>
