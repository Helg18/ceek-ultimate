<nav class="navbar navbar-default navbar-fixed-top navbar-scroll navbar-transparent">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <img src="/public/ceek-v3/img/ceek-white.svg" alt="Ceek">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
          
            <ul class="nav navbar-nav navbar-right">
                @if (App::environment('local'))
                    <li><a href="{{ route('pages.vr-headset') }}" title="vr headset">buy vr headset</a></li>
                @endif              
                <li><a href="{{ route('pages.ceek.megadeth') }}" title="megadeth">megadeth vr</a></li>
                <li><a href="{{ route('pages.vr-labs') }}" title="vr labs">vr labs</a></li>
                <li><a href="{{ route('pages.support') }}" title="support">support</a></li>
                <!--li><a href="{{ route('pages.blog') }}" title="blog">blog</a></li-->
                <li><a class="selected login-toggle" title="login">login</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>