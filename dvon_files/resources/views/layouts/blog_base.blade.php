<?php
    use Carbon\Carbon;
?>
<!doctype html>
<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js " lang="en"> <!--<![endif]-->
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Site Meta -->
    <title>{{$slug}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{$logo}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{$logo}}">

	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet"> 
	
    <!-- Custom & Default Styles -->
	<link rel="stylesheet" href="{{ asset('blog/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/swiper.min.css') }}">
    <style>
        #student-registration-form{
            display: none;
        }
        .swiper-container {
      width: 100%;
      height: 100%;

    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
    </style>

	<!--[if lt IE 9]>
		<script src="{{ asset('blog/js/vendor/html5shiv.min.js') }}"></script>
		<script src="{{ asset('blog/js/vendor/respond.min.js') }}"></script>
	<![endif]-->

</head>
<body>  

    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="{{ asset('blog/images/loader.gif') }}" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">
        <!-- BEGIN # MODAL LOGIN -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Begin # DIV Form -->
                    <div id="div-forms">
                        <form id="login-form">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="flaticon-add" aria-hidden="true"></span>
                            </button>
                            <div class="modal-body">
                                <input class="form-control" type="text" placeholder="What you are looking for?" required>
                            </div>
                        </form><!-- End # Login Form -->
                    </div><!-- End # DIV Form -->
                </div>
            </div>
        </div>
        <!-- END # MODAL LOGIN -->

    <header class="header">
        <div class="topbar clearfix">
            <div class="container">
                <div class="row-fluid">
                    <div class="col-md-6 col-sm-6 text-left">
                        <p>
                            <strong><i class="fa fa-phone"></i></strong> {{$blog_owner->phone}} &nbsp;&nbsp;
                            <strong><i class="fa fa-envelope"></i></strong> <a href="mailto:{{$blog_owner->email}}">{{$blog_owner->email}}</a>
                        </p>
                    </div><!-- end left -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end topbar -->

        <div class="container">
            <nav class="navbar navbar-default yamm">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo-normal">
                        <a class="navbar-brand" href="/blog/{{preg_replace("/-/","/", $slug)}}"><img style="width: 90px; height:50px" src="{{$logo}}" alt=""></a>
                    </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/blog/{{preg_replace("/-/","/", $slug)}}">Home</a></li>
                        <li class="dropdown hassubmenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                            @guest
                            <li><a href="{{route('login')}}">Login</a></li>
                            @endguest

                            @auth
                            @endauth

                            @guest
                            <li><a href="{{ route('register')}}">Register</a></li>
                            @endguest
                            
                            @auth
                            
                            <li><a href="{{ route('password.request') }}">Reset Password</a></li>
                                {{-- <li><a href="#">Logout</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                </form>
                            </li>
                            @endauth
                        </li>
                        
                    </ul>
                    
                </div>
            </nav><!-- end navbar -->
        </div><!-- end container -->
    </header>
        @yield('content')

    <footer class="section footer noover">
        <div class="container">
            <div class="row">
                <div class="col col-12">
                    <p class="text-center">
                        Powered by dnvonline
                    </p>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->
    <script src="{{ asset('blog/js/jquery.min.js') }}"></script>
    <script src="{{ asset('blog/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('blog/js/carousel.js') }}"></script>
    <script src="{{ asset('blog/js/animate.js') }}"></script>
    <script src="{{ asset('blog/js/custom.js') }}"></script>
    <!-- VIDEO BG PLUGINS -->
    <script src="{{ asset('blog/js/videobg.js') }}"></script>
    <script src="{{ asset('blog/js/swiper.min.js') }}"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
          spaceBetween: 30,
          centeredSlides: true,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      </script>

</body>
</html>