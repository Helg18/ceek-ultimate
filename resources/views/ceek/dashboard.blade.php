<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>ceek</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <script src="//use.typekit.net/mpt4imp.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
        <link rel="shortcut icon" href="/public/ceek-v2/favicon.png">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/public/ceek-v1/styles/main.css">
        <script href="/public/ceek-v1/scripts/vendor/modernizr.js"></script>
    </head>
    <body>
        <!--[if lt IE 10]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <div class="mobile-menu green-gradient-background dropdown container-fluid hidden-lg hidden-md">
            <div class="row">
                <div class="icon-container col-xs-2">
                    <button id="profile-menu-toggle" class="button tertiary toggle-button profile-menu-toggle" type="button" data-toggle="dropdown">
                        <span class="icon icon-user"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
{{--
                        <li class="menu__item">
                            <a href="#">Photos</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">profile</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Preferences</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">My Account</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Subscribe</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Log Out</a>
                        </li>
--}}
                    </ul>
                </div>
                <div class="icon-container col-xs-2 col-xs-offset-8">
                    <button id="general-menu-toggle" class="button tertiary toggle-button general-menu-toggle" type="button" data-toggle="dropdown">
                        <i class="icon icon-menu"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">{{--
                        <li class="menu__item">
                            <a href="#">Facebook</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Twitter</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Status Update</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Notifications</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Buy Points</a>
                        </li>
                        <li class="menu__item">
                            <a href="#">Ceek VIP</a>
                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>
        <main class="main container-fluid homepage">
            <div class="row convenient-container">
                <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-lg-offset-3 col-lg-6 panel-box">
                    <div class="box master">
                        <!-- <div class="blurred-background"></div> -->
                        <div class="row panel__title">
                            <h1>Welcome {{ Auth::user()->username }}</h1>
                            <div class="white-layer"></div>
                        </div>
                        <div class="row sources-container">
                            <div class="col-xs-12">
                                <div class="desktop-sources hidden-xs">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p class="sources-contaier__subtitle">Launch Ceek</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{--
                                        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                            <a href="ceek://{{ urlencode(json_encode([ 'username' => Auth::user()->username, 'gender' => Auth::user()->gender, 'profilePicture' => isset( Auth::user()->avatar->url ) ? URL::to('/') . Auth::user()->avatar->url : ''])) }}" class="source box col-md-pull-right" style="margin: 0px;">
                                                <div class="vcenter">
                                                    <div class="vobject">
                                                        <i class="icon icon-windows"></i>
                                                        <p class="text-capitalize">windows</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        --}}
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="vcenter">
                                                <a href="https://itunes.apple.com/us/app/ceek-vr/id1072665725?mt=8" target="_blank"><img src="/public/ceek-v3/img/ios-app.png" alt="iOS App Store" style="max-width: 100%;"></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 c">
                                            <a href="https://play.google.com/store/apps/details?id=com.eonreality.ceekvr&hl=en" target="_blank"><img src="/public/ceek-v3/img/google-play.png" alt="iOS App Store" style="max-width: 100%;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <?php /*
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-sm-3">
                        <ul>
                            <li>
                                <span>Ceek</span>
                            </li>
                            <li>Founders welcome</li>
                            <li>the state of our unions</li>
                            <li>About us</li>
                            <li>Facebook FAQ</li>
                            <li>Work at Ceek</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <ul>
                            <li>
                                <span>Legal</span>
                                </li><li>Press Release</li>
                                <li>Terms and Conditions</li>
                                <li>Provacy Policy</li>
                                <li>Contact Us</li>
                                <li>Support</li>

                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <ul>
                            <li>
                                <span>Business</span>
                            </li>
                            <li>Advertise Partner With Us</li>
                            <li>Add your place</li>
                            <li>Create an event</li>
                            <li>Become featured listing</li>
                            <li>Investors</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <ul>
                            <li>
                                <span>Experts & Writers</span>
                            </li>
                            <li>Writer's Guidelines</li>
                            <li>Contributor Registration</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="footer-text">
                            Ceek is the hot new way to <span>meet singles</span> and <span>find fun things</span> to do. Why go to concerts, movies or museums
                            by yourself when you can go with other fun singles?
                        </p>
                        <p class="footer-text">
                            Sign Up Now and <span>meet people</span> and find things to do. Ask <span>relationship advice</span> or <span>dating questions</span>, read the <span>dating blog</span> or simply <span>find a date</span>.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="footer-text">
                            <span>2014 &copy; Next Galaxy Corp (OTCBB: NXGA) All Rights Reserved.</span>
                        </p>
                        <p class="footer-text">
                            Next Galaxy Corp does not conduct background checks on the members or subscribers of this website at this time.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        */ ?>

        <script href="/public/ceek-v1/scripts/vendor.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>

                <script href="/public/ceek-v1/scripts/main.js"></script>
</body>
</html>
