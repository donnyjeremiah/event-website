<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="css/vendor/bootstrap.min.css" rel="stylesheet" type="text/css"/> -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Error: 404 <script src="assets/js/modernizr.js"></script> -->
    @yield('style')
    <style>
    .main-content {
        margin-top: 70px;
        margin-bottom: 80px;
        /* background-color: #987865; */
    }
    .btn-h1-spacing {
        margin-top: 10px;
    }
    </style>
  </head>

  <body>
      @include('includes.header')
      @include('includes.message')
      <div class="main-content">
          @yield('content')
      </div>
      @include('includes.footer')

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
      <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/js/retina-1.1.0.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.hoverdir.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.hoverex.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.isotope.min.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>

      @yield('script')
  </body>
</html>
