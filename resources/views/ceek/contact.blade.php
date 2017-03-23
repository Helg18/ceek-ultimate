@extends('layouts.landing')
@section('meta-description')
CEEK is the only comprehensive and secure content platform for all devices. Live an amazing VR Experiences enjoying VR Concerts, games and sports
@stop
@section('title')
<title>Contant | CEEK</title>
@stop
@section('content') 
	<main id="fullpage" class="privacy about">

        <section id="contact_info">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 no-pad capa">
                        <div class="row">
                        	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">			                            
	                            <ul class="list-unstyled wow fadeIn" data-wow-duration="1s">
	                            	<li>
	                            		<img src="/public/ceek-v3/img/location-01.svg" alt="" />
	                            		<p>1680 Michigan Ave, Suite 700<br>Miami Beach FL 33139</p>
	                            	</li>
	                            	<li>
	                            		<img src="/public/ceek-v3/img/phone-01.svg" alt="" />                                        
	                            		<p>(877) 407-9797<br>M-F | 9am - 6pm EST</p>
	                            	</li>
	                            	<li>
	                            		<img src="/public/ceek-v3/img/mail-01.svg" alt="" />
	                            		<a href="mailto:support@ceek.com">support@ceek.com</a>
	                            	</li>
                                </ul>
		                    </div>
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-sm-6 no-pad">
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB1XcmGP6Ck86YfDDp9n2PL_XqO5j5ZcVA
    &q=Space+1680+Michigan+Ave,+Miami+Beach,+FL+33139"></iframe>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop