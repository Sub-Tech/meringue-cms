<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/limitless/assets/css/animate.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ URL::asset('/limitless/assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/limitless/assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/limitless/assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/limitless/assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript"
            src="{{ URL::asset('/limitless/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{ URL::asset('/limitless/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/limitless/assets/js/pages/login.js')}}"></script>

    <script type="text/javascript" src="{{ URL::asset('/limitless/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container bg-slate-800">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Advanced login -->
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i>
                            </div>
                            <h5 class="content-group-lg">Login In
                                <small class="display-block">Enter your credentials</small>
                            </h5>
                        </div>


                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" placeholder="Email Address" name="email"
                                   value="{{ old('email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                   value="{{ old('password') }}">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn bg-pink-400 btn-block">Login <i
                                        class="icon-circle-right2 position-right"></i></button>
                        </div>


                        <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>

                        <a href="/register" class="btn bg-slate btn-block content-group legitRipple">Register</a>

                    </div>
                </form>
                <!-- /advanced login -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
