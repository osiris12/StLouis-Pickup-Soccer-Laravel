<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'St. Louis Pickup Soccer') }}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <link href="{{asset('css/custom.css')}}?v={{env('CSS_V')}}" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="{{env('URL')}}slicker/slick/slick.css?v={{env('CSS_V')}}"/> 
        <link rel="stylesheet" type="text/css" href="{{env('URL')}}slicker/slick/slick-theme.css?v={{env('CSS_V')}}"/>

        <!-- Styles -->
        <link href="{{env('URL')}}css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            .radio-inline+.radio-inline{
                margin-left: 0px;
            }
            table.account td{
                float: left;
            }
        </style> 

    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>
                </div>
            </nav>
            @yield('image_upload')
            @yield('display_account')
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>  
        <script type="text/javascript" src="{{env('URL')}}slicker/slick/slick.min.js"></script>
    </body>  
</html>
