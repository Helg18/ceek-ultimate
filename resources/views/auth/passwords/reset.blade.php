<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="nofollow">
    <title>Reset Password | Ceek</title>
    <!-- Bootstrap Core CSS -->
    <link href="/public/ceek-v3/css/vendor/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="/public/ceek-v3/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/public/ceek-v3/favicon.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- The #page-top ID is part of the scrolling feature -
the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body>

    <!-- Login window -->
    <div class="login-window" style="display: block; opacity: 1;" id="window-for-code">
        <div class="container">
            <div class="login" style="display: block; opacity: 1;">
                <img class="logo" src="/public/ceek-v3/img/logo-color.png" alt="Ceek logo">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form" method="POST" action="{{ url('/password/reset') }}" id="code-form" >
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="redemptionCode" style="width: 100%; text-align: left;"><small>Your Email</small></label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <input type="email" placeholder="user@domain.com" value="{{ old('email') }}" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="redemptionCode" style="width: 100%; text-align: left;"><small>New Password</small></label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="redemptionCode" style="width: 100%; text-align: left;"><small>Confirm Password</small></label>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button id = "Login" class="btn-gradient" type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Velocity JS -->
    <script src="/public/ceek-v3/js/vendor/jquery.velocity.min.js"></script>
    <!-- Selectric JS -->
    <script src="/public/ceek-v3/js/vendor/jquery.selectric.js"></script>
    <!-- Image Picker JS -->
    <script src="/public/ceek-v3/js/vendor/jquery.image-picker.min.js"></script>
    <!-- wNumb JS -->
    <script src="/public/ceek-v3/js/vendor/wNumb.js"></script>
    <!-- noUISlider JS -->
    <script src="/public/ceek-v3/js/vendor/nouislider.min.js"></script>
    <!-- Dropzone JS -->
    <script src="/public/ceek-v3/js/vendor/dropzone.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/public/ceek-v3/js/vendor/bootstrap.min.js"></script>
    <!-- Init JS stuff -->
    <script src="/public/ceek-v3/js/general.js"></script>
</body>
</html>