<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Boto | Photography HTML Template</title>
    <meta charset="UTF-8">
    <meta name="description" content="Boto Photo Studio HTML Template">
    <meta name="keywords" content="photo, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/fresco.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    <style>
        /* Mobile-first responsive additions */
        @media (max-width: 767.98px) {
            /* Header adjustments */
            .header {
                padding: 15px 0;
            }
            
            .header__social, .header__switches {
                text-align: center;
                margin: 10px 0;
            }
            
            .site-logo img {
                max-height: 40px;
            }
            
            /* Navigation */
            .main__menu {
                margin-top: 15px;
            }
            
            .nav__menu {
                flex-direction: column;
                align-items: center;
            }
            
            .nav__menu li {
                margin: 5px 0;
            }
            
            /* Footer */
            .footer__copyright__text {
                text-align: center;
                font-size: 14px;
            }
            
            /* Search modal */
            .search-model-form input {
                width: 80%;
            }
        }
        
        @media (min-width: 768px) {
            /* Desktop-specific styles */
            .header {
                padding: 30px 0;
            }
            
            .nav__menu {
                justify-content: center;
            }
            
            .nav__menu li {
                margin: 0 20px;
            }
        }
        
        /* General responsive improvements */
        .site-logo img {
            max-width: 100%;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .header__social a, .header__switches a {
            margin: 0 10px;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        
        .header__social a:hover, .header__switches a:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }
        
        .menu--active {
            font-weight: bold;
            position: relative;
        }
        
        .menu--active:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: currentColor;
        }
        
        /* Mobile menu toggle */
        .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
        }
        
        @media (max-width: 991.98px) {
            .mobile-menu-toggle {
                display: block;
                text-align: center;
            }
            
            .nav__menu {
                display: none;
                width: 100%;
            }
            
            .nav__menu.show {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section -->
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4 col-sm-4 col-md-3 order-2 order-sm-1">
                    <div class="header__social">
                        <a href="#" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-6 order-1 order-md-2 text-center">
                    <a href="{{ url('/') }}" class="site-logo">
                        <img src="{{ asset('frontend/img/logo.png') }}" alt="Boto Photography Logo">
                    </a>
                </div>
                <div class="col-4 col-sm-4 col-md-3 order-3 order-sm-3 text-end">
                    <div class="header__switches">
                        <a href="/login" aria-label="Login"><i class="fa fa-user"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu toggle -->
            <div class="mobile-menu-toggle d-lg-none">
                <i class="fa fa-bars"></i>
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
            <div class="footer__copyright__text">
                <p>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fresco.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    
    <script>
        // Mobile menu toggle functionality
        $(document).ready(function() {
            $('.mobile-menu-toggle').click(function() {
                $('.nav__menu').toggleClass('show');
            });
            
            // Close mobile menu when clicking a link
            $('.nav__menu a').click(function() {
                if ($(window).width() < 992) {
                    $('.nav__menu').removeClass('show');
                }
            });
            
            // Responsive image handling
            $('img').each(function() {
                $(this).addClass('img-fluid').css('max-width', '100%');
            });
            
            // Prevent layout shift by preloading logo
            const logo = new Image();
            logo.src = "{{ asset('frontend/img/logo.png') }}";
        });
    </script>
</body>
</html>