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
        <link href="{{asset('css/custom.css')}}" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="slicker/slick/slick.css"/> 
        <link rel="stylesheet" type="text/css" href="slicker/slick/slick-theme.css"/>

        <!-- Styles -->
        <link href="https://lit-temple-21110.herokuapp.com/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .thumbnail a > img, .thumbnail > img {
                height: 400px;
                width: 100%;
            }

            .carousel{ 
                background: #2f4357;
                margin-top: 20px;
            }
            .carousel .item{
                min-height: 280px; /* Prevent carousel from being distorted if for some reason image doesn't load */
            }
            .carousel .item img{
                margin: 0 auto; /* Align slide image horizontally center */
                width: 100%;
                height: 400px;
            }
            .bs-example{
                margin: 20px;
            }

            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center; 
            }

            .title {
                color: grey;
                font-size: 18px;
            }

            button {
                border: none;
                outline: 0;
                display: inline-block;
                padding: 8px;
                color: white;
                background-color: #000;
                text-align: center;
                cursor: pointer;
                width: 100%;
                font-size: 18px;
            }

            a {
                text-decoration: none;
                font-size: 22px;
                color: black;
            }

            button:hover, a:hover {
                opacity: 0.7;
            }




            * {
                box-sizing: border-box;
            }

            .slider {
                width: 50%;
                margin: 100px auto;
            }

            .slick-slide {
                margin: 0px 20px;
            }

            .slick-slide img {
                width: 100%;
            }

            .slick-prev:before,
            .slick-next:before {
                color: black;
            }


            .slick-slide {
                transition: all ease-in-out .3s;
                opacity: .2;
            }

            .slick-active {
                opacity: .5;
            }

            .slick-current {
                opacity: 1;
            }

        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    @yield('test')
                </div>
            </nav>
        </div>
        <!-- Scripts -->


        <script src="{{ asset('js/app.js') }}"></script>  
        <script type="text/javascript" src="slicker/slick/slick.min.js"></script>
    </body> 
</html>
