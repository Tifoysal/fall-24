<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    Giftos
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{url('/frontend/css/bootstrap.css')}}" />

  <!-- Custom styles for this template -->
  <link href="{{url('/frontend/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{url('/frontend/css/responsive.css')}}" rel="stylesheet" />

  @notifyCss

  <style type="text/css">
    .notifyjs-wrapper {
      z-index: 111111;
      position: absolute;
      display: inline-block;
      height: 0;
      width: 0;
    }
  </style>
</head>

<body>
  <div class="hero_area">


    @include('frontend.fixed.header')

    @include('notify::components.notify')

    <!-- slider section -->

    @yield('content')



    @include('frontend.fixed.footer')



    <script src="{{url('/frontend/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('/frontend/js/bootstrap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="{{url('/frontend/js/custom.js')}}"></script>
    @notifyJs
</body>

</html>