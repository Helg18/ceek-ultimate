@extends('layouts.package')
@section('meta-description')
A VR Experience! Join MEGADETH for a 5 song VR concert in 360 video with 3D immersive audio. Get it now! Includes VR Cardboard Headset
@stop
@section('title')
<title>Megadeth VR Experience: Dystopia</title>
@stop
@section('content') 
    <main id="fullpage">

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
              <div class="content text-center megadeth">
                <h1 class="wow slideInDown" data-wow-duration="1s">Megadeth Dystopia VR Experience</h1>
                <p><strong>BE THERE</strong> Live with the legends for this first of its kind VR Experience! Join MEGADETH for a 5 Song VR Concert in 360 degrees with 3D immersive audio. Plus a bonus track featuring a full immersive 360 experience!</p>
                <p>
                  <a href="#vr-cardbox" class="btn btn-gradient equal">buy now</a>
                </p>                
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="vr-cardbox">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="content text-center">
                <p class="lead">The Megadeth VR Cardbox has everything needed to transform your Apple or Android smart phone screen into a super immersive Mega VR experience including lenses, magnets and more!</p>  
                
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="wow slideInDown" data-wow-duration="1s">megadeth vr cardbox</h2>
                <p class="wow fadeIn visible-xs" data-wow-duration="1s">
                  <img src="/public/ceek-v3/img/megadeth-cardbox.png" class="img-responsive" alt="Megadeth VR Cardbox">
                </p>
                <p class="visible-xs">
                  <a href="{{ route('pages.final-step', 2) }}" class="btn btn-gradient">BUY NOW</a>
                </p>
                <p class="visible-xs"><strong>$9.99</strong><br>Megadeth VR Concert<br> 
                  <span>Includes: Megadeth VR Concert Access + Cardbox Headset.</span>
                </p>
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="wow slideInDown" data-wow-duration="1s">megadeth vr cardbox <span>deluxe pack</span></h2>
                <p class="wow fadeIn visible-xs" data-wow-duration="1s">
                  <img src="/public/ceek-v3/img/megadeth-deluxe.png" class="img-responsive" alt="Megadeth VR Cardbox Deluxe">
                </p>
                <p class="visible-xs">
                  <a href="http://www.bestbuy.com/site/dystopia-deluxe-fan-package-only--best-buy-cd-vr-goggles-cd/4747101.p?skuId=4747101" target="_blank" class="btn btn-gradient">BUY NOW</a>
                </p>
                <p class="visible-xs"><strong>$16.99</strong><br>Deluxe Pack Megadeth VR Concert<br> 
                  <span>Includes: CD + Megadeth VR Concert Access + Cardbox Headset.</span>
                </p>
              </div>

              <div class="col-sm-6 text-center hidden-xs">
                <img src="/public/ceek-v3/img/megadeth-cardbox.png" class="img-responsive" alt="Megadeth VR Cardbox">
              </div>
              <div class="col-sm-6 text-center hidden-xs">
                <img src="/public/ceek-v3/img/megadeth-deluxe.png" class="img-responsive" alt="Megadeth VR Cardbox Deluxe">
              </div>
              <div class="col-sm-6 text-center hidden-xs">
                <p class="">
                    <a href="{{ route('pages.final-step', 2) }}" class="btn btn-gradient">BUY NOW</a>
                  </p>
                  <p class=""><strong>$9.99</strong><br>Megadeth VR Concert<br> 
                    <span>Includes: Megadeth VR Concert Access + Cardbox Headset.</span>
                  </p>
              </div>
              <div class="col-sm-6 text-center hidden-xs">
                <p class="">
                    <a href="http://www.bestbuy.com/site/dystopia-deluxe-fan-package-only--best-buy-cd-vr-goggles-cd/4747101.p?skuId=4747101" target="_blank" class="btn btn-gradient">BUY NOW</a>
                  </p>
                  <p class=""><strong>$16.99</strong><br>Deluxe Pack Megadeth VR Concert<br> 
                    <span>Includes: CD + Megadeth VR Concert Access + Cardbox Headset.</span>
                  </p>
              </div>
            </div>

          </div>
        </div>
      </section>

      <section class="section" id="mega-death-in-vr">        
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="content text-center">
                <h2 class="wow slideInDown" data-wow-duration="1s">EXPERIENCE MEGADETH IN CUTTING EDGE VR ON CEEK!</h2>
                <p>Iconic thrash rock band Megadeth comes to CEEK with a VR experience of five songs from Dystopia, “Fatal Illusion,” “Dystopia,” The Threat Is Real,” “Poisonous Shadows,” and “Post American World.”</p>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6y6isjV8uig?rel=0&amp;wmode=transparent"></iframe>
                </div>              
                <p>
                  The band’s performance will appear within the fallen city of a dystopian world modeled after the world created in Megadeth’s new music video for “The Threat Is Real.” The 360 experience will be composited into CEEK’s CG VR environment to create a dystopian universe surrounding the band, and allow fans to virtually enter, engage and explore this parallel world.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="download-access">        
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="content text-center">
                <h2 class="wow slideInDown" data-wow-duration="1s">DOWNLOAD &amp; ACCESS</h2>
                <p class="lead">Once you have your cardbox, accessing the Megadeth experience is easy! Just follow the simple instructions below. Don’t have a cardbox yet?</p>                

                <div class="row">
                  <div class="col-sm-4 col-sm-offset-1">
                    <p>STEP 1<br>
                      <span class="text-muted">Download the CEEK app for iOS or Android.</span>
                    </p>
                    <p>
                      <a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
                        <img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" height="70">
                      </a>
                    </p>
                    <p>
                      <a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
                        <img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" height="70">
                      </a>
                    </p>
                  </div>
                  <div class="col-sm-4 col-sm-offset-2">
                    <p>STEP 2<br> 
                      <span class="text-muted">Find the access code located under your cardbox. Then launch the app, enter the code and enjoy!</span>
                    </p>
                    <img src="/public/ceek-v3/img/locate-the-code.jpg" class="img-responsive center-block" alt="access code">
                  </div>
                </div>
                                              
              
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="content text-center">
                      <h2 class="wow slideInDown fix" data-wow-duration=".8s">cardbox assembly instructions</h2>
                      <p class="lead">Assembling your cardbox is easy. Watch the video below for instructions.</p>
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/DSq42GZR_vg?rel=0&amp;wmode=transparent"></iframe>
                      </div>                 
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
@stop