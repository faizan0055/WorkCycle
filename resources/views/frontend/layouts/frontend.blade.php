<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link href="images/fav.png" rel="shortcut icon" type="image/x-icon"/>
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS-->
    <link href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/mega.menu.css')}}" rel="stylesheet">
    <!-- Fontawesome styles for this template-->
    <link href="{{asset('frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    @yield('style')
<!-- Fontawesome styles for this template-->
</head>

<body>
<div id="preloader">
    <div id="status" style="background-image: url({{url('images/dokanamar.gif')}});">&nbsp;</div>
</div>
    <!--header start-->
        <header id="header" class="default">
            <div class="topbar text-white" style="background-color: #ff0125;color: white">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="topbar-left text-center text-md-left">
                                    <ul class="list-inline">
                                        <li> <a href="contact.html"> Contact </a></li>
                                        <li> <a href="about.html"> About Us </a></li>
                                        <li> <a href="partner_with_us.html"> Become a Partner </a></li>
                                        <li> <a href="our_blog.html"> Location </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="topbar-right text-center text-md-right">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="far fa-calendar-alt"></i>Table Bookings</a> </li>
                                        <li><a href="#"><i class="far fa-bookmark"></i>Bookmarks <span class="badge badge-secondary">2</span></a></li>
                                        <li><a href="#"><i class="fas fa-shopping-cart"></i>Food Orders <span class="badge badge-secondary">3</span></a></li>

                                        <li class="nav-item dropdown">
                                        <a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> @if(auth()->check()) {{auth()->user()->name}} @else Sign In/Sign Up  @endif  <i class="fas fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                                                @if(auth()->check())
                                              <a class="dropdown-item" href="{{route('user.profile')}}"> My Profile</a>
                                              <a class="dropdown-item" href="#"> Bookmarks</a>
                                              <a class="dropdown-item" href="#"> Booking Tables</a>
                                              <a class="dropdown-item" href="#"> Find Friends</a>
                                              <a class="dropdown-item" href="setting.html"> Setting</a>
                                              <a class="dropdown-item" href="{{route('logout')}}"> Logout</a>
                                              @else

                                              <a class="dropdown-item" href="{{route('signin')}}">Sign In</a>
                                              <a class="dropdown-item" href="{{route('signup')}}"> Sign Up</a>

                                              @endif

                                           </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <div class="menu-left text-center text-md-left">
                                <div class="logo-box">
                                    <a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="menu-items">
                                <nav class="navbar navbar-expand-lg navbar-light bg-light menu-right">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav mr-auto nav-text">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{url('/')}}">Home </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="how_to_orders.html">How To Orders?</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="recipes.html">Recipes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="partners.html">Partners</a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle-no-caret" href="#" id="megaDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pages <i class="fas fa-caret-down"></i></a>
                                                <div class="dropdown-menu mega-menu dropdown-menu-right">
                                                    <div class="row">
                                                    <div class="col-md-3">
                                                        <a class="dropdown-item" href="about.html"> About us</a>
                                                        <a class="dropdown-item" href="recipe_details.html"> Recipes Detail View</a>
                                                        <a class="dropdown-item" href="upload_recipe.html"> Upload Recipe</a>
                                                        <a class="dropdown-item" href="partners.html"> Partners</a>
                                                        <a class="dropdown-item" href="restaurant_detail.html"> Restaurant Detail View</a>
                                                        <a class="dropdown-item" href="partner_with_us.html"> Become a Partner</a>
                                                        <a class="dropdown-item" href="add_restaurant.html"> Add Restaurant</a>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <a class="dropdown-item" href="add_driver.html"> Add Driver</a>
                                                        <a class="dropdown-item" href="meals.html"> Meals</a>
                                                        <a class="dropdown-item" href="meal_detail.html"> Meal Detail View</a>
                                                        <a class="dropdown-item" href="checkout.html"> Checkout</a>
                                                        <a class="dropdown-item" href="bill_slip.html"> Bill Slip</a>
                                                        <a class="dropdown-item" href="browse_places.html"> Browse Places</a>
                                                        <a class="dropdown-item" href="places_nearby.html"> Near Places</a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a class="dropdown-item" href="places_cafes.html"> Cafes & More</a>
                                                        <a class="dropdown-item" href="upcoming_events.html"> Upcoming Events</a>
                                                        <a class="dropdown-item" href="event_detail.html"> Event Detail View</a>
                                                        <a class="dropdown-item" href="user_profile_view.html"> User Profile View</a>
                                                        <a class="dropdown-item" href="my_profile_dashbord.html"> My Order Dashboard</a>
                                                        <a class="dropdown-item" href="restaurant_partner_dashbord.html"> Restaurant Partner Dashboard</a>
                                                        <a class="dropdown-item" href="driver_partner_dashbord.html"> Driver Partner Dashboard</a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a class="dropdown-item" href="setting.html"> My Setting</a>
                                                        <a class="dropdown-item" href="error_404.html"> Error 404</a>
                                                        <a class="dropdown-item" href="signin.html"> Login Now</a>
                                                        <a class="dropdown-item" href="faq.html"> FAQ</a>
                                                        <a class="dropdown-item" href="our_blog.html"> Our Blog</a>
                                                        <a class="dropdown-item" href="blog_detail.html"> Single Blog Detail View</a>
                                                        <a class="dropdown-item" href="contact.html"> Contact</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="browse_places.html">Browse Places</a>
                                            </li>
                                        </ul>
                                    </div>

                                </nav>
                                <div class="icons-set">
                                    <ul class="list-inline">
                                        <li class="icon-items nav-item dropdown ">
                                        <a class="nav-link dropdown-toggle-no-caret" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                                            <div class="notification-item">
                                                <div class="search-details">
                                                    <form class="form-inline">
                                                      <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                                                      <button class="s-btn btn-link " type="submit"><i class="fas fa-search"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </li>
                                        <li class="icon-items nav-item dropdown">
                                        <a class="nav-link dropdown-toggle-no-caret" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                            <div class="notification-item">
                                                <div class="property">
                                                    <ul>
                                                        <li><div class="setting"><a href="#">Setting</a></div></li>
                                                        <li><div class="clear"><a href="#">Clear</a></div></li>
                                                    </ul>
                                                </div>
                                                <div class="notification-details">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#"><img src="{{asset('frontend/images/notification-img-2.png')}}" alt=""></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Jassica William</h4>
                                                            <p>comment on your Video.</p>
                                                            <div class="comment-date">10 min ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#"><img src="{{asset('frontend/images/notification-img-3.png')}}" alt=""></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Congratulations!</h4>
                                                            <p>Your Order is Accepted.</p>
                                                            <div class="comment-date">
                                                                15 min ago
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#"><img src="{{asset('frontend/images/notification-img-4.png')}}" alt=""></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Order Delivered!</h4>
                                                            <p>Your Order is Delivered.</p>
                                                            <div class="comment-date">20 min ago</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </li>
                                        <li class="partner-btn">
                                            <a href="partner_with_us.html" class="b-btn btn-link">Become a Partner</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <!--header end-->
    <!--banner start-->
    <!--banner end-->

    @yield('content')
    @include('frontend.layouts.footer')
<div id="loader" class="lds-dual-ring hidden overlay"></div>
     <!--Bootstrap core JavaScript-->
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!--Core plugin JavaScript-->
    <script src="{{asset('frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
     <!--Assect scripts for this page-->
    <script src="{{asset('frontend/vendor/OwlCarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('frontend/js/owlslider.js')}}"></script>
<script>
    $(window).on('load', function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow':'visible'});
    })
</script>
    @yield('script')

  </body>

</html>
