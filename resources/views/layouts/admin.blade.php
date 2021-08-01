<!--
Author: Sundalkar, Gabriel Anand
ID: 1001774881
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
    <title>@yield('title') </title>
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/gabriel.css') }}">

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Navbar -->
    <div id="navbar" class="navbar navbar-wander-green flex-wrap">
        <div class="container flex mobile-nav">
            <h1>Diaspora</h1>
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
                            <a href="{{ route('login', app()->getLocale()) }}">
                                <button class="btn btn-outline-accent text-accent">Login / Signup</button>
                            </a>
                        </div>

            @endif

            <a id="btnMenu" href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>


    <nav class="sidenav">
        <ul class="sidenav-list">
            <li class="sidenav-list-item"><i class="fas fa-home" style="margin-right: 20px;"></i> Home</li>
            <li class="sidenav-list-item"><i class="fas fa-hand-holding-heart" style="margin-right: 20px;"></i>
                Contributions</li>
            <li class="sidenav-list-item"><i class="fas fa-map-marked-alt" style="margin-right: 20px;"></i> Places of
                Interest</li>
        </ul>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ URL::asset('js/admin.js') }}"></script>
</body>

</html>
