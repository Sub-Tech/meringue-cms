<html>
<head>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="{{ theme_asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/cover.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/main.css') }}">
{{--    <link rel="stylesheet" href="{{ theme_asset('css/owl.carousel.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ theme_asset('css/owl.theme.default.min.css') }}">--}}
    <link rel="stylesheet" href="{{ theme_asset('css/buttons.css') }}">

    <script src="{{ theme_asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ theme_asset('js/main.js') }}"></script>

    <!-- Fonts -->

    <link href="{{ theme_asset('fonts/lovelo-fontface.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('fonts/FontAwesome.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('fonts/ionicons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
</head>

<body>
<div class="main-menu">
    <div class="container wide-container">
        <div class="row">
            <div class="col-md-2">
                <a class="logo" href="/"></a>
            </div>
            <div class="col-md-10 menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/gdpr">GDPR</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/team">Meet The Team</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
<?php if($_SERVER['REQUEST_URI'] === '/') { ?>
<section class="hero is-fullheight is-primary homePageHeader">
    <video autoplay loop>
        <source src="{{ theme_asset('videos/header3.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1>We Understand Your Leads</h1>
            <p>Our first class lead generation delivered results instantly</p>
            <a href="/" class="btn btn-lg btn-white">Pure Lead Generation</a>
            <a href="/" class="btn btn-lg btn-clear">Affiliate Network</a>
        </div>
    </div>
</section>
<?php } ?>
