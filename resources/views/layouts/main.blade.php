<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
</head>
<body>
{{-- navbar --}}
        <section class="head-top">
            <div class="nav-background-image">
                <div class="container">
                    <div class="img-holder">
                        <img src="images/grace.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="head">
            <header id="navigation">
                <div class="navbar navbar-inverse navbar-fixed-top" role="banner">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="scroll"><a href="index.html">Home</a></li>
                                <li class="scroll"><a href="about.html">About Us</a></li>
                                <li class="scroll"><a href="sign_in.php">Sign-in</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="women.html">Womenfolk</a></li>
                                        <li><a href="book.html">Bookworm</a></li>										
                                        <li><a href="fashion.html">Fashion Pioneer</a></li>
                                        <li><a href="beauty.html">Beauty Bloom</a></li>
                                        <li><a href="fitness.html">Fitness Freak</a></li>										
                                        <li><a href="recipe.html">Cook Food</a></li>
                                        <li><a href="decor.html">Home Decor</a></li>										
                                        <li><a href="wedding.html">Wedding Bells</a></li>
                                        <li><a href="love.html">Affiliation</a></li>
                                        <li><a href="baby.html">Motherhood</a></li>										
                                        <li><a href="medic.html">Medicare</a></li>
                                        <li><a href="photo.html">Photography</a></li>
                                    </ul>
                                </li>
                                <li class="scroll"><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/navbar-->
            </header>
            <!--/#navigation-->
        </section>
{{-- navbar ends --}}
    @yield('body')
</body>
</html>