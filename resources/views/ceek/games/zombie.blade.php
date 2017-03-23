@extends('layouts.games')
@section('meta-description')
Zombie Chase is a dynamic and exciting Virtual Reality Game at first person that unfolds in an apocalyptic Virtual Reality World
@stop
@section('title')
<title>Zombie Chase a bloody Virtual Reality Game</title>
@stop
@section('content')
	<main id="fullpage">
		<section id="zombie">        	
			<video autoplay loop muted playsinline class="bg-video-games hidden-xs" id="videoM" poster="/public/ceek-v3/img/games/zombie/Zombie-Chase-video-back.jpg">
	        	<source src="/public/ceek-v3/img/games/zombie/video/Zombie-Chase-promo-video-2.mp4" type="video/mp4">
	        	<source src="/public/ceek-v3/img/games/zombie/video/Zombie-Chase-promo-video-2.webm" type="video/webm">	        	
      		</video>
      		<img src="/public/ceek-v3/img/games/zombie/video/Zombie-Chase-promo-video-2.gif" class="bg-video visible-xs" alt="">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
							<div class="effect">
								<img src="/public/ceek-v3/img/games/zombie/ZombieChase_Logo3.png" class="img-responsive" alt="Zombie Chase">    
								<p class="text-zombie hidden-xs">
									<span>Game action unfolds in an apocalyptic city and its suburbs.</span>
									<span>The game is a dynamic ﬁrst person virtual reality runner.</span>
									<span>The main character runs away from the insidious monsters who strive to attack.</span>
								</p>
							</div>
					</div>
				</div>
			</div>
		</section>
		<section id="game_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p class="text-zombie visible-xs">
							<span>Game action unfolds in an apocalyptic city and its suburbs.</span>
							<span>The game is a dynamic ﬁrst person virtual reality runner.</span>
							<span>The main character runs away from the insidious monsters who strive to attack.</span>
						</p>

						<h4 class="donwload-now">download now</h4>
						<div class="icons-apps">
							<ul class="list-unstyled list-inline">
								<li>
									<a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
										<img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/oculus.svg" alt="Oculus" width="150">
									</a>
								</li>
							</ul>
						</div>						
					</div>
				</div>
				<div class="row hidden-sm hidden-xs">
					<div class="col-sm-12">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/JM03a7aMA0U" frameborder="0" allowfullscreen></iframe>
						</div>  
					</div>
				</div>
				<div class="row ">
					<div class="col-md-6">
						<div class="visible-xs">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/JM03a7aMA0U" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>

						<h3>Monsters are everywhere</h3>
						<p>
							<img src="/public/ceek-v3/img/games/zombie/AppIcon-2-1.png" class="pull-left hidden-sm hidden-xs" alt="">
							Running behind you, they jump from the side and above, jumping from buildings and everything.
						</p>
						<p>In addition, you will encounter various obstacles such as falling rubble, cracked asphalt, holes in the ground, burning cars and much more. The goal of the game is to reach the end of the level. During the game, players can collect various bonuses such as run acceleration, super jumps, lives and coins.</p>
						<div class="visible-sm">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/JM03a7aMA0U" frameborder="0" allowfullscreen></iframe>								
							</div>
						</div>
						<div class="hidden-xs">
							<p>Zombie Chase is an action packed ﬁrst person VR adventure endless runner that challenges the player from start to ﬁnish. You start off as either one of the main characters where you must escape the zombie infested apocalyptic city in search of the quarantined safe zone. From the city to the country and everywhere in between run, dodge and shoot your way to the safe zone away from the brain-eating zombies!!! </p>
							<p>Join in the fun with Zombie Chase </p>
							<p>Jump over burning cars, shoot ﬂesh eating zombie dogs and run as fast as you can from the monster zombie pigs that will crush you and eat your bones.</p>
						</div>
					</div>

					<div class="col-md-6">
						<div class="controls">
							<h3 class="upper">controls</h3>
							<ul class="list-unstyled">
								<li>
									<div class="row">
										<div class="col-sm-3 col-xs-4">
											<img src="/public/ceek-v3/img/games/zombie/icon-first-person.svg" alt="">
										</div>
										<div class="col-sm-9 col-xs-8">
											<h6>First-person view</h6>
											<p class="small">
												Automatic forward movement of the character.
											</p>
										</div>
									</div>															
								</li>
								<li>
									<div class="row">
										<div class="col-sm-3 col-xs-4">
											<img src="/public/ceek-v3/img/games/zombie/icon-game-pad.svg" alt="">									
										</div>
										<div class="col-sm-9 col-xs-8">
											<h6>Gamepad</h6>
											<p class="small">
												Should be used to move left or right and jump, to avoid the obstacles and also for shooting.
											</p>
										</div>
									</div>									
								</li>
								<li>
									<div class="row">
										<div class="col-sm-3 col-xs-4">
											<img src="/public/ceek-v3/img/games/zombie/icon-rotate.svg" class="mg8" alt="">
										</div>
										<div class="col-sm-9 col-xs-8">
											<h6>Rotate character</h6>
											<p class="small">
												Left / Right and Jump.
											</p>
										</div>
									</div>																
								</li>
								<li>
									<div class="row">
										<div class="col-sm-3 col-xs-4">
											<img src="/public/ceek-v3/img/games/zombie/icon-vr-technology.svg" class="mg8" alt="">
										</div>
										<div class="col-sm-9 col-xs-8">
											<h6>VR Technology</h6>
										</div>
									</div>																	
								</li>
							</ul>
						</div>      					
					</div>
					
					<div class="col-sm-6 visible-xs">
						<p>Zombie Chase is an action packed ﬁrst person VR adventure endless runner that challenges the player from start to ﬁnish. You start off as either one of the main characters where you must escape the zombie infested apocalyptic city in search of the quarantined safe zone.</p>
						<p>From the city to the country and everywhere in between run, dodge and shoot your way to the safe zone away from the brain-eating zombies!!!</p>
						<p>Join in the fun with Zombie Chase </p>
						<p>Jump over burning cars, shoot ﬂesh eating zombie dogs and run as fast as you can from the monster zombie pigs that will crush you and eat your bones.</p>
					</div>
				
					<div class="col-md-6 text-center hidden-lg hidden-md">
						<h4 class="donwload-now">download now</h4>
						<div class="icons-apps">
							<ul class="list-unstyled list-inline">
								<li>
									<a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
										<img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/oculus.svg" alt="Oculus" width="150">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container-fluid">
				<div class="row">

						<div id="slider" class="flexslider">
						  <ul class="slides">
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/002_montaje_tablet_movil.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/004_montaje_movil_tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 2</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/006_montaje_movil_tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 3</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/007_movil_tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 4</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/011_movil-Tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 5</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/016_movil_tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 6</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/017_movil-tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 7</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						    <li>
						    	<img src="/public/ceek-v3/img/games/zombie/gallery/018_movil_tablet.jpg" />
						    	<div class="caption">
						    		<h4>SCENES<br>Day time scene 8</h4>
						    		<p>City center. Tall buildings.</p>
						    	</div>
						    </li>
						  </ul>
						  <div class="customDirection container">
						  	<a href="" class="left flex-prev"><i class="glyphicon glyphicon-menu-left"></i></a>
						  	<a href="" class="right flex-next"><i class="glyphicon glyphicon-menu-right"></i></a>
						  </div>
						</div>
					
				</div>
			</div>

		</section>
		<section id="game_bottom">
			<div class="container">				
				<div class="row">
					<div class="col-sm-12">
						<div id="carousel2" class="flexslider">
  						<ul class="slides">
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-2-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-4-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-6-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-7-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-011-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-016-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-017-thumb.jpg" /></li>	
  							<li><img src="/public/ceek-v3/img/games/zombie/gallery/zombie-chase-018-thumb.jpg" /></li>	
  						</ul>
  					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h3>your enemies</h3>
					</div>
					<div class="col-sm-4">
						<div class="enemies">
							<img src="/public/ceek-v3/img/games/zombie/enimies_human.jpg" class="img-responsive">
							<h3>Zombie Human</h3>
						</div>      					
					</div>
					<div class="col-sm-4">
						<div class="enemies">
							<img src="/public/ceek-v3/img/games/zombie/Enemies_ZombieDogs.jpg" class="img-responsive">
							<h3>Zombie Dogs</h3>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="enemies">
							<img src="/public/ceek-v3/img/games/zombie/Enemies_Monsters.jpg" class="img-responsive">
							<h3>Monsters</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-center">
						<h4 class="donwload-now">download now</h4>
						<div class="icons-apps">
							<ul class="list-unstyled list-inline">
								<li>
									<a href="https://itunes.apple.com/us/app/ceek-virtual-reality/id1169054349?mt=8" target="_blank">
										<img src="/public/ceek-v3/img/ios-logo.svg" alt="iOS App Store" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/google-play-logo.svg" alt="Google Play" width="150">
									</a>
								</li>
								<li>
									<a href="https://play.google.com/store/apps/details?id=com.ceekvr.virtualrealityconcerts&hl=en" target="_blank">
										<img src="/public/ceek-v3/img/oculus.svg" alt="Oculus" width="150">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop