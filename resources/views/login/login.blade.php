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
    <title>Diaspora | Login</title>
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
                            <p>{{ __('Welcome to Diaspora') }}</p>
                            <p>{{ __('Welcome Home') }}</p>
                        </div>
                        <p class="login-heading">{{ __('Login to continue.') }}</p>
                    </div>
                    <form role="form" action="/login" method="post">
                        @csrf
                        <div class="form-label-group">
                            <input name="email" type="email" id="email" class="form-control" placeholder="{{ __('E-mail') }}"
                                required>
                            <!-- <label for="email">E-Mail</label> -->
                        </div>
                        <div class="form-label-group">
                            <input name="password" type="password" id="inputPassword" class="form-control"
                                placeholder="{{ __("Password") }}" required>
                            <!-- <label for="inputPassword">Password</label> -->
                        </div>
                        <br>
                        <button
                            class="btn btn-lg btn-primary-w btn-block btn-login text-uppercase font-weight-bold mb-2"
                            type="submit">{{ __('SIGN IN') }}</button>
                        <br>
                            @if(isset($msg))
                            <div class="flex flex-vertical">
                                <p class="wander-green">{{ $msg }}</p>
                            </div>
                            @endif

                        <div class="flex flex-vertical">
                            <p>{{ __("Not registered yet? No problem! Let's get you started.") }}</p>
                            <a class="text-accent" href="/signup">{{ __('Create Account') }}</a>
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

