<!DOCTYPE html>
<html lang="zh-TW">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ secure_asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ secure_asset('css/portfolio-item.css') }}" rel="stylesheet">

  </head>

  <body>
	@include('frontend.layouts.navbar')
	@yield('content')
	@include('frontend.layouts.footer')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ secure_asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>