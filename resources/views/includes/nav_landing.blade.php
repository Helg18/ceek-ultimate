<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top navbar-scroll navbar-transparent" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle">
      <span class="sr-only">Toggle navigation</span>
      <i class="fa fa-bars"></i>
      </button>
      <div class="navbar-brand">
        <a href="/" title="Ceek">
        <img src="/public/ceek-v3/img/ceek-white.svg" alt="Ceek">
        </a>
      </div>
    </div>
    <!-- This is the nav for desktop only. Hidden on mobile -->
    <div class="nav-desktop">
      <ul class="nav navbar-nav navbar-right">               
         
        <li><a href="{{ route('pages.support') }}" title="support">support</button></form></li>
        <li><a href="{{ route('pages.home') }}" title="blog">blog</a></li>
        <li><button class="btn login-toggle">login</button></li>
      </ul>
    </div>

  </div>
  <!-- /.container -->
</nav>