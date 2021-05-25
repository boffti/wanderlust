<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}"/>
    <title>Diaspora | Signup</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="shortcut icon" href="">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="signup-page">
        <div class="grid grid-2">
            <a href="/">
                <img class="signup-img" src="{{ URL::asset('img/suitcases.jpg') }}" alt="">
            </a>
            <div class="signup-form flex-vertical">
                <img src="{{ URL::asset('img/destination.png') }}" alt="" style="width: 100px;" class="">
                <div class="card">
                    <div class="flex-vertical">
                        <h1 class="login-heading"></h1>
                        <div id="typed">
                            <p>{{ __("Welcome to your new home") }}</p>
                            <p>{{ __("Welcome to Diaspora") }}.</p>
                        </div>
                        <p class="login-heading mb-4">{{ __("Create an account to get started.") }}</p>
                    </div>
                    <form role="form" action="/signup-handler" method="post">
                        @csrf
                        <div class="">
                            <input name="name" type="name" id="name" class="" placeholder="{{ __("Full Name") }}"
                                required autofocus>
                            <!-- <label for="name">Full Name</label> -->
                        </div>
                        <div class="">
                            <input name="email" type="email" id="email" class="" placeholder="{{ __("E-mail") }}"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                title="xxx@xxx.xxx"
                                required>
                            <!-- <label for="email">E-Mail</label> -->
                        </div>
                        <div class="">
                            <input name="password" type="password" id="inputPassword" class=""
                                placeholder="{{ __("Password") }}"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
                                title="8-12 letters, Atleast 1 uppercase, lowercase, symbol and number."
                                required>
                            <!-- <label for="inputPassword">Password</label> -->
                        </div>
                        <div class="">
                            <input name="reenter-password" type="password" id="inputPasswordReenter"
                                class="" placeholder="{{ __("Re-enter Password") }}" required>
                            <!-- <label for="inputPasswordReenter">Re-enter Password</label> -->
                        </div>
                            @if(isset($msg))
                                <div class="flex flex-vertical">
                                    <p class="wander-green">{{ $msg }}</p>
                                </div>
                            @endif

                        <br>
                        <button
                            class="btn btn-lg"
                            type="submit">{{ __("SIGN UP") }}</button>
                        <br>
                        <div class="flex flex-vertical">
                            <p>{{ __("Already have an account?") }}</p>
                            <a class="text-accent" href="/login">{{ __("Sign In") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ URL::asset('js/typed.js') }}"></script>
    <script>
        var typed = new Typed('.login-heading', {
            stringsElement: '#typed',
            showCursor: false,
            typeSpeed: 70,
            backSpeed: 70,
            backDelay: 5000,
        });
    </script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
</body>

</html>
