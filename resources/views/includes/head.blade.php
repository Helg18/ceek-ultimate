    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="VR Experience, MEGADETH, VR Concert, 3D immersive audio, immersive 360 experience">
    <meta name="author" content="CEEK">

    <meta name="msapplication-config" content="/public/ceek-v3/ieconfig.xml">
    @if (App::environment('local')) 
        <meta name="robots" content="noindex,nofollow"/>
    @else 
        <meta name="google-site-verification" content="hnI_rHRxvGX_e4xXbYo_Pm_HWmbUXn5deU8tHDIEs4k"/>
    @endif
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="/public/ceek-v3/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/public/ceek-v3/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/ceek-v3/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/public/ceek-v3/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/ceek-v3/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/public/ceek-v3/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/public/ceek-v3/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/public/ceek-v3/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/ceek-v3/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/public/ceek-v3/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/ceek-v3/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/ceek-v3/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/ceek-v3/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/public/ceek-v3/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/public/ceek-v3/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- title -->
    @yield('title')    
    <!-- Bootstrap Core CSS -->
    <link href="/public/ceek-v3/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/ceek-v3/css/animate.css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" href="/public/ceek-v3/css/ie10-viewport-bug-workaround.css">
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="/public/ceek-v3/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @if (App::environment('production'))
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script',' https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-90749676-1', 'auto');
            ga('send', 'pageview');
        </script>
    @endif