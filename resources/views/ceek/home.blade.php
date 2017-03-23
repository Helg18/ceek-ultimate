@extends('layouts.landing')
@section('meta-description')
CEEK is the only comprehensive and secure content platform for all devices. Live an amazing VR Experiences enjoying VR Concerts, games and sports
@stop
@section('title')
<title>CEEK | VR Experiences Platform, Virtual Reality Concerts</title>
@stop
@section('content')  
  <div class="section-wrapper">
    <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="20000" data-pause="hover">
      <div class="carousel-inner" role="listbox">

        <div class="item active">
          <section class="jumbotron">
            
            <video autoplay loop muted playsinline class="bg-video hidden-xs" id="videoM">
              <source src="/public/ceek-v3/video/new_home.mp4" type="video/mp4">
              <source src="/public/ceek-v3/video/new_home.webm" type="video/webm">              
            </video>
            <img src="/public/ceek-v3/video/new_home.gif" class="bg-video visible-xs" alt="">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <div class="content">
                    <h1>
                      <span>Be</span><br /> <span>there</span>
                    </h1>
                    <p class="description">                  
                      Explore, share and live the moment with friends. Enjoy virtual reality concerts, sports, learning, events and much more.
                    </p>
                    <!--form action="{{ route('auth.socialite.facebook.out') }}" method="GET">
                        {!! Form::token() !!}
                        <button class="btn-gradient connect-facebook">Connect with Facebook</button>
                    </form-->
                    <!--button class="signup signup-toggle">Or <span class="inline-link">sign up</span> with your email</button-->
                    <p class="description">Download the CEEK app for iOS or Android</p>
                    <p class="description text-left">
                      <a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
                        <img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" height="40">
                      </a>
                      <a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
                        <img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" height="40">
                      </a>
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 pd-right0 hidden-xs">
                  <div class="content right">
                    <p class="description">CEEK has been featured in:</p>
                    <img src="/public/ceek-v3/img/partners/press-logos-ceek-v8.png" class="img-responsive" alt="">
                  </div>
                </div>
              </div>
              
            </div>

          </section>
          <!-- /.jumbotron -->
        </div>
        <div class="item">
          <section class="section" id="home">
            <div class="overlay"></div>
            <video autoplay loop muted playsinline class="bg-video hidden-xs" id="videoM">
              <source src="/public/ceek-v3/video/Poison_Test_Loop.mp4" type="video/mp4">
              <source src="/public/ceek-v3/video/Poison_Test_Loop.webm" type="video/webm">              
            </video>
            <img src="/public/ceek-v3/video/Poison_Test_Loop.gif" class="bg-video visible-xs" alt="">
            <div class="container">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="content text-center">
                    <h1 class="wow slideInDown" data-wow-duration="1s">Megadeth Dystopia VR Experience</h1>
                    <p><strong>BE THERE</strong> Live with the legends for this first of its kind VR Experience! Join MEGADETH for a 5 Song VR Concert in 360 degrees with 3D immersive audio. Plus a bonus track featuring a full immersive 360 experience!</p>
                    <p>
                      <a href="{{ route('pages.ceek.megadeth') }}" class="btn btn-new">LEARN MORE</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <section class="featured visible-xs">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="description">CEEK has been featured in:</p>
            <img src="/public/ceek-v3/img/partners/press-logos-mobile.svg" alt="" />
          </div>
        </div>
      </div>
    </section>
    <section id="download-access-home">
      <!-- <div class="overlay-grey"></div> -->
      <div class="container">        
        <div class="row">
          <div class="col-sm-12">
            <div class="content text-center">
              <h2>DOWNLOAD &amp; ACCESS</h2>
              <p>
                Once you have your cardbox, accessing CEEK is easy! Just follow the simple instructions below. Don’t have a VR set yet? Download the CEEK app for iOS or Android.</p>
              <a class="btn" href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
                <img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" height="70">
              </a>
              <a class="btn" href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
                <img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" height="70">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="vr-cardbox">
      <!-- <div class="overlay-grey"></div> -->
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="content text-center">
              <h2>Megadeth VR Cardbox for Virtual Reality Experiences</h2>
              <p data-wow-duration="1s"><img src="/public/ceek-v3/img/megadeth-cardbox.png" class="img-responsive" alt="Megadeth VR Cardbox"></p>
              <p class="lead">The Megadeth VR Cardbox has everything needed to transform your Apple or Android smart phone screen into a super immersive Mega VR experience including <i>lenses, magnets and more!</i></p>
              <p><a href="{{ route('pages.final-step', 2) }}" class="btn btn-gradient bold">BUY NOW</a></p>
              <p><strong>$9.99</strong> for the Megadeth VR Concert<br>
              Includes: Megadeth VR Concert Access + Cardbox Headset.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop