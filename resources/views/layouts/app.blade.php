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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css"
        integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>


<body>
    <!-- Navbar -->
    <div id="navbar" class="navbar navbar-primary flex-wrap">
        <div class="container flex mobile-nav">
            <div class="flex" style="overflow: hidden;">
                <div class="dropdown">
                    <a href="#">
                        <h1>
                            <span class="flag-icon {{ app()->getLocale() == 'en' ? 'flag-icon-us' : 'flag-icon-ve' }}"></span>
                        </h1>
                    </a>
                    <ul class="dropdown-content" style="top:50px">
                        <li class="dropdown-item">
                            <a href="{{ route(Route::currentRouteName(), 'en') }}">
                            <span class="flag-icon flag-icon-us"></span>
                            &nbsp;English
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route(Route::currentRouteName(), 'esp') }}">
                                <span class="flag-icon flag-icon-ve"></span>
                                &nbsp;Español
                            </a>
                        </li>
                    </ul>
                </div>
                <h1> &nbsp; {{ __('Diaspora') }}</h1>
            </div>
            <nav>
                <ul class="hidden">
                    <li class="{{ $page == 'home' ? 'active-link' : '' }}"><a
                            href="{{ route('home', app()->getLocale()) }}">{{ __('Home') }}</a></li>
                    <li class="{{ $page == 'about' ? 'active-link' : '' }}"><a
                            href="{{ route('about', app()->getLocale()) }}">{{ __('About') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="">{{ __('Services') }} <i class="fas fa-angle-down"
                                style="margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item {{ $page == 'immigrant_services' ? 'active-link' : '' }}"
                                    href="{{ route('immigrant_services', app()->getLocale()) }}">{{ __('Immigrant Services') }}</a>
                            </li>
                            <li><a class="dropdown-item {{ $page == 'visitor_services' ? 'active-link' : '' }}"
                                    href="{{ route('visitor_services', app()->getLocale()) }}">{{ __('Visitor Services') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="https://wanderlust.axm0503.uta.cloud/blog/" target="__blank">{{ __('Blog') }}</a>
                    </li>
                    <li class="{{ $page == 'contact' ? 'active-link' : '' }}"><a
                            href="{{ route('contact', app()->getLocale()) }}">{{ __('Contact') }}</a></li>
                </ul>
            </nav>

            <!-- ! If user not in session -->
            <!-- <div class="signup">
                <button class="btn btn-outline-secondary">Login / Signup</button>
            </div> -->
            @if (session()->has('user'))
                {{-- @if (in_array('3', session()->get('user_roles')))
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
                            <img id="avatarIMG"
                                src="{{ URL::asset('upload/user_dp/') }}/{{ session('user')['dp'] }}"
                                alt="profile" class="avatarIMG">
                            <p id="profileName" class="profileName">{{ session('user')['full_name'] }}</p>
                            <i class="fas fa-angle-down" style="margin-left: 8px;"></i>
                        </a>
                        <ul class="dropdown-content" style="top:50px">
                            <li class="dropdown-item">
                                <a href="{{ route('profile', app()->getLocale()) }}">
                                    <i class="fas fa-user" style="margin-right: 8px;"></i>
                                    {{ __('My Profile') }}
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="/chat/{{ session('user_loc')['city_id'] }}">
                                    <i class="fas fa-comments" style="margin-right: 8px;"></i>
                                    {{ __('Chatroom') }}
                                </a>
                            </li>
                            @if (in_array('3', session('user_roles')))
                                <li class="dropdown-item">
                                    <a href="/country-admin">
                                        <i class="fas fa-tools" style="margin-right: 8px;"></i>
                                        {{ __('Admin Console') }}
                                    </a>
                                </li>
                            @endif
                            @if (in_array('4', session('user_roles')))
                                <li class="dropdown-item">
                                    <a href="/super-admin">
                                        <i class="fas fa-toolbox" style="margin-right: 8px;"></i>
                                        {{ __('Super Admin Console') }}
                                    </a>
                                </li>
                            @endif
                            <li class="dropdown-item">
                                <a href="{{ route('logout', app()->getLocale()) }}">
                                    <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <div class="signup">
                    <a href="{{ route('login', app()->getLocale()) }}">
                        <button class="btn btn-outline-accent text-accent">{{ __('Login / Signup') }}</button>
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
                    <h6>{{ __('About') }}</h6>
                    <p class="text-justify"><i>{{ __('Diaspora') }}</i>
                        {{ __('is a portal for immigrants who have just moved to a new location. They can use the provided services to find places of interest around them. They can rate and review businesses and upload photos and videos to their profile.') }}
                    </p>
                </div>

                <div class="">
                    <h6>{{ __('Categories') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('Restaurants') }}</a></li>
                        <li><a href="#">{{ __('Shopping') }}</a></li>
                        <li><a href="#">{{ __('Education') }}</a></li>
                        <li><a href="#">{{ __('Religion & Worship') }}</a></li>
                        <li><a href="#">{{ __('Entertainment') }}</a></li>
                        <li><a href="#">{{ __('Health & Medical') }}</a></li>
                    </ul>
                </div>

                <div class="">
                    <h6>{{ __('Quick Links') }}</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('about', app()->getLocale()) }}">{{ __('About') }}</a></li>
                        <li><a
                                href="{{ route('immigrant_services', app()->getLocale()) }}">{{ __('Immigrant Services') }}</a>
                        </li>
                        <li><a
                                href="{{ route('visitor_services', app()->getLocale()) }}">{{ __('Visitor Services') }}</a>
                        </li>
                        <li><a href="/blog">{{ __('Blog') }}</a></li>
                        <li><a href="{{ route('contact', app()->getLocale()) }}">{{ __('Contact') }}</a></li>
                        <li><a href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="grid grid-3">
                <div class="">
                    <p class="copyright-text">{{ __('Diaspora') }} &copy; {{ __('2021. All Rights Reserved.') }}
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
                <div><a class="wander-green" href="{{ route(Route::currentRouteName(), 'en') }}">EN</a> | <a
                        class="wander-green" href="{{ route(Route::currentRouteName(), 'esp') }}">ESP</a></div>
            </div>
        </div>
    </footer>

    <!-- ! If user in session -->
    <div id="location-select-modal-container" class="modal-container">
        <div class="modal" id="location-select-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">{{ __('Select Location') }}</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="{{ route('change-loc', app()->getLocale()) }}" method="post" class="flex-center"
                    style="gap: 12px;">
                    @csrf
                    <div class="form-control"> <select id="location-select" name="location" id="location" required>

                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">{{ __('Cancel') }}</button>
                        <button class="btn" type="submit">{{ __('Change') }}</button>
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
