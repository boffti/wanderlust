<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" />
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    @yield('css-imports')
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>


<body>
    <!-- Navbar -->
    <div id="navbar" class="navbar navbar-primary flex-wrap">
        <div class="container flex mobile-nav">
            <h1>Wanderlust</h1>
            <nav>
                <ul class="hidden">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="">Services <i class="fas fa-angle-down" style="margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="/immigrant-services">Immigrant
                                    Services</a></li>
                            <li><a class="dropdown-item" href="/visitor-services">Visitor
                                    Services</a></li>
                        </ul>
                    </li>
                    <li><a href="https://wanderlust.axm0503.uta.cloud/blog/">Blog</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>

            <!-- ! If user not in session -->
            <!-- <div class="signup">
                <button class="btn btn-outline-secondary">Login / Signup</button>
            </div> -->
            @if(session()->has('user'))
                {{-- @if(in_array('3', session()->get('user_roles')))
                @endif --}}
                {{-- Drop Down as per user roles --}}
                        <!-- ! If user in session -->
                        <ul class="hidden">
                            <li>
                                <a id="currentLocation" href="#" class="navbar-location flex currentLocation">
                                    <i class="fas fa-map-marker-alt loc-icon"></i>
                                    {{ session('user_loc')['city_name'] }}
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="profile flex">
                                    <img id="avatarIMG" src="{{ URL::asset("upload/user_dp/") }}/{{ session('user')['dp'] }}" alt="profile" class="avatarIMG">
                                    <p id="profileName" class="profileName">{{ session('user')['full_name'] }}</p>
                                    <i class="fas fa-angle-down" style="margin-left: 8px;"></i>
                                </a>
                                <ul class="dropdown-content" style="top:50px">
                                    <li class="dropdown-item">
                                        <a href="/profile">
                                            <i class="fas fa-user" style="margin-right: 8px;"></i>
                                            My Profile
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="/chat/{{ session('user_loc')['city_id'] }}">
                                            <i class="fas fa-comments" style="margin-right: 8px;"></i>
                                            Chatroom
                                        </a>
                                    </li>
                                    @if(in_array('3', session('user_roles')))
                                    <li class="dropdown-item">
                                        <a href="/country-admin">
                                            <i class="fas fa-tools" style="margin-right: 8px;"></i>
                                            Admin Console
                                        </a>
                                    </li>
                                    @endif
                                    @if(in_array('4', session('user_roles')))
                                    <li class="dropdown-item">
                                        <a href="/super-admin">
                                            <i class="fas fa-toolbox" style="margin-right: 8px;"></i>
                                            Super Admin Console
                                        </a>
                                    </li>
                                    @endif
                                    <li class="dropdown-item">
                                        <a href="/logout">
                                            <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @else
                        <div class="signup">
                            <a href="/login">
                                <button class="btn btn-outline-accent text-accent">Login / Signup</button>
                            </a>
                        </div>

            @endif

            <a id="btnMenu" href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>

    @yield('content')

    <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="grid grid-3">
                <div class="">
                    <h6>About</h6>
                    <p class="text-justify"><i>WANDERLUST</i> is a portal for immigrants who have just moved to a new
                        location. They can use the provided services to find places of interest around them. They can
                        rate and review businesses and upload photos and videos to their profile.</p>
                </div>

                <div class="">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <li><a href="#">Restaurants</a></li>
                        <li><a href="#">Shopping</a></li>
                        <li><a href="#">Education</a></li>
                        <li><a href="#">Religion & Worship</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Health & Medical</a></li>
                    </ul>
                </div>

                <div class="">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="/about">About</a></li>
                        <li><a href="/immigrant-services">Immigrant Services</a></li>
                        <li><a href="/visitor-services">Visitor Services</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/login">Login</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="grid grid-3">
                <div class="">
                    <p class="copyright-text">Wanderlust &copy; 2021. All Rights Reserved.
                    </p>
                </div>

                <div style="margin-top: 10px;">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- ! If user in session -->
    <div id="location-select-modal-container" class="modal-container">
        <div class="modal" id="location-select-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Select Location</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="/change-loc" method="post" class="flex-center" style="gap: 12px;">
                    @csrf
                    <div class="form-control"> <select id="location-select" name="location" id="location">

                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
                        <button class="btn" type="submit">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    @yield('scripts')
    <script src="{{ URL::asset('js/app.js') }}"></script>
<body>

</body>

</html>
