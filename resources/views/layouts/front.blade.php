<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Shop Madalin Gavrila">
    <meta name="author" content="Madalin Gavrila">

    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/libs.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

    <!-- CUSTOM CSS -->
    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
@yield('navbar')

<!-- Page Content -->
<div class="container">

    <div class="row">

        @yield('flash_message')

        @yield('category')

        <div class="col-md-9">

            @yield('carousel')

            @yield('content')

        </div>

    </div>

</div>
<!-- /.container -->

<div class="container">

    <!-- Footer -->
    @yield('footer')

</div>
<!-- /.container -->

<!-- JS -->
<script src="{{asset('js/libs.js')}}"></script>

<!-- CUSTOM JS -->
@yield('scripts')

</body>

</html>