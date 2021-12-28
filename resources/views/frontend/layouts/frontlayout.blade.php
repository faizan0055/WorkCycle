<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    @yield('style')
    <style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        /* change if the mask should have another color then white */
        z-index: 99;
        /* makes sure it stays on top */
    }

    #status {
        width: 300px;
        height: 300px;
        position: absolute;
        left: 50%;
        /* centers the loading animation horizontally one the screen */
        top: 50%;
        /* centers the loading animation vertically one the screen */
        background-image: url({{url('images/27474-products.gif')}});
        /* path to your loading animation */
        background-repeat: no-repeat;
        background-position: center;
        margin: -100px 0 0 -100px;
        background-size: 300px 300px;
        /* is width and height divided by two */
    }
     .Checkbox{
    width: 1.3em;
    height: 1.3em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #ddd;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
  }
  .Checkbox:checked {
    background-color: #38c172;
    position: relative;
  }
  .Checkbox:checked::after{
      content: "";
      position: absolute;
      width: 7px;
      height: 11px;
      border-right: 2px solid #fff;
      border-bottom: 2px solid #fff;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%) rotateZ(40deg)
  }

</style>
</head>
<body>
    <div id="preloader">
    <div id="status">&nbsp;</div>
</div>
@yield('content')
@include('frontend.layouts.footer')
<script src="{{ asset('frontend/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/frontend/js/jquery.nice-number.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    $(window).on('load', function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow':'visible'});
    })
</script>
@yield('scripts')
</body>
</html>
