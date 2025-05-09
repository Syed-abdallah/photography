<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Boto | Photography HTML Template</title>
    <meta charset="UTF-8">
    <meta name="description" content="Boto Photo Studio HTML Template">
    <meta name="keywords" content="photo, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/fresco.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />



</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 col-md-3 order-2 order-sm-1">
                    <div class="header__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-6 order-1  order-md-2 text-center">
                    <a href="./index.html" class="site-logo">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
                <div class="col-sm-4 col-md-3 order-3 order-sm-3">
                    <div class="header__switches">
              
                        <a href="/login"><i class="fa fa-user"></i></a> <!-- Login Icon -->
                    </div>
                </div>
                
            </div>
            <nav class="main__menu">
                <ul class="nav__menu">
                    <li>
                        <a href="{{ url('/') }}" 
                           class="{{ Request::is('/') ? 'menu--active' : '' }}">
                           Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/contact_us') }}" 
                           class="{{ Request::is('contact_us') ? 'menu--active' : '' }}">
                           Contact
                        </a>
                    </li>
                </ul>
            </nav>
            
        </div>
    </header>


    @yield('content')
   

    <footer class="footer__section">
        <div class="container">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <div class="footer__copyright__text">
                <p>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                </p>
            </div>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </footer>
    <!-- Footer Section end -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fresco.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>
