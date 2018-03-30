<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <title>CRM | Register</title>

    <!-- Mobile App Configuration -->
    @include('layouts.components.mobile')

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=greek" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="/assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="/assets/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="/assets/css/app_1.css" rel="stylesheet">
</head>

<body>
    <div class="login-content bgm-pink">

        <div class="lc-block toggled" id="l-login">
            <h1 style="color:#fff;margin-bottom:20px">CRM</h1>

            {!! Form::open(['url' => route('auth.register'), 'method' => 'POST']) !!}
                <div class="lcb-form" style="padding:35px 25px 35px 25px">

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="fg-line">
                            <input type="text" name="name" class="form-control" placeholder="ΟΝΟΜΑ">
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <div class="fg-line">
                            <input type="email" name="email" class="form-control" placeholder="EMAIL">
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <div class="fg-line">
                            <input type="password" name="password" class="form-control" placeholder="ΚΩΔΙΚΟΣ">
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <div class="fg-line">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="ΚΩΔΙΚΟΣ ΞΑΝΑ">
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn bgm-teal">ΕΓΓΡΑΦΗ</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Javascript Libraries -->
    <script src="/assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/bower_components/Waves/dist/waves.min.js"></script>

    <script src="/assets/js/app.min.js"></script>
</body>
</html>