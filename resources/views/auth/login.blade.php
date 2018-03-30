<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
  <meta charset="utf-8">
  <title>CRM | Σύνδεση</title>

  <!-- Mobile App Configuration -->
  @include('layouts.components.mobile')

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=greek" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="/assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
  <link href="/assets/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">

  <!-- CSS -->
  <link href="/assets/css/app_1.css?v={{ config('assets.version') }}" rel="stylesheet">
  <link href="/assets/css/app_2.css?v={{ config('assets.version') }}" rel="stylesheet">
  <link href="/assets/css/custom.css?v={{ config('assets.version') }}" rel="stylesheet">
</head>

<body class="bgm-white">

  <div class="mdnsign">
    <div class="mdnhead bgm-pink">
      <div class="mdnheadinner">
        <div class="mdntitle">
          <div class="c-white f-s-20">Σύνδεση</div>
        </div>
      </div>
    </div>

    <div class="mdnbody">
      <div class="mdnbodyinner">
        <div class="p-40">
          {!! Form::open(['url' => route('auth.login'), 'method' => 'POST']) !!}

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              <div class="fg-line">
                <input type="email" name="email" class="form-control" placeholder="EMAIL" value="{{ Request::old('email') }}">
              </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
              <div class="fg-line">
                <input type="password" name="password" class="form-control" placeholder="ΚΩΔΙΚΟΣ">
              </div>
            </div>

            <div class="text-right">
              <button class="btn bgm-pink btn-lg waves-effect">ΕΠΟΜΕΝΟ</button>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Javascript Libraries -->
  <script src="/assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/assets/vendors/bower_components/Waves/dist/waves.min.js"></script>

  <script src="/assets/js/app.js?v={{ config('assets.version') }}"></script>
</body>
</html>