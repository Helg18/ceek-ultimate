var wow = new WOW({
	boxClass:     'wow',      // animated element css class (default is wow)
	animateClass: 'animated', // animation css class (default is animated)
	offset:       0,          // distance to the element when triggering the animation (default is 0)
	mobile:       true,       // trigger animations on mobile devices (default is true)
	live:         true,       // act on asynchronously loaded content (default is true)
	callback:     function(box) {
	// the callback is fired every time an animation is started
	// the argument that is passed in is the DOM node being animated
	},
	scrollContainer: null // optional scroll container selector, otherwise use window
});
wow.init();

var $window = $(window),
    flexslider = { vars:{} };
 
// tiny helper function to add breakpoints
function getGridSize() {
return (window.innerWidth < 600) ? 4 :
       (window.innerWidth < 992) ? 6 : 8;
}

// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
	if( $(window).width() > 767) {
        if ($(".navbar").length > 0 ) {
    		if ($(".navbar").offset().top > 50) {
    			$(".navbar-fixed-top").removeClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    		} else {
    			$(".navbar-fixed-top").addClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
    		}
        }
    } else {
		$(".navbar-fixed-top").removeClass("navbar-transparent");
		$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    }
});

function fallback(video)
{
  var img = video.querySelector('img');
  if (img)
    video.parentNode.replaceChild(img, video);
}

// pageloader
$(window).load(function(){
	if($(".preloader").length > 0){
		$('.preloader').fadeOut(1000);
	}
	if( $(window).width() > 767) {
        if ($(".navbar").length > 0 ) {
    		if ($(".navbar").offset().top > 50) {
    			$(".navbar-fixed-top").removeClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    		} else {
    			$(".navbar-fixed-top").addClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
    		}
        }
    } else {
		$(".navbar-fixed-top").removeClass("navbar-transparent");
		$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    }
    if($('#slider').length > 0) {

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            customDirectionNav: $(".customDirection a"),
            sync: "#carousel2"
        });

        $('#carousel2').flexslider({
            animation: "slide",
            controlNav: true,
            directionNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 145,
            itemMargin: 0,
            minItems: getGridSize(),
            maxItems: getGridSize(),
            asNavFor: '#slider'
        });
    }
});

$(window).resize(function(){
    var gridSize = getGridSize();
 
    flexslider.vars.minItems = gridSize;
    flexslider.vars.maxItems = gridSize;

	if( $(window).width() > 767) {
        if ($(".navbar").length > 0 ) {
    		if ($(".navbar").offset().top > 50) {
    			$(".navbar-fixed-top").removeClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    		} else {
    			$(".navbar-fixed-top").addClass("navbar-transparent");
    			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
    		}
        }
    } else {
	   $(".navbar-fixed-top").removeClass("navbar-transparent");
	   $(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
    }
});


$(function() {
	$('[data-toggle="popover"]').popover();

	$(".addressbox").change(function(){
		// make sure of the checked state...
		// hide the fields if the checkbox is checked...
		// 'this' is the checkbox...
		if ($(this).is(":checked")) // fixed error here! ;)
		  $(".ship-info").slideUp("slow", function(){

		  	$('.shipping_name').val($('.name').val());
		  	$('.shipping_lastname').val($('.lastname').val());
		  	$('.shipping_address').val($('.address').val());
		  	$('.shipping_address_two').val($('.address_two').val());
		  	$('.shipping_city').val($('.city').val());
            $('.shipping_state option[value='+ $('.states').val() +']').prop("selected",true);
		  	$('.shipping_zipcode').val($('.zipcode').val());		  	
		  	$('.shipping_email').val($('.email').val());
            $('.shipping_phone').val($('.phone').val());
		  });
		else
		  $(".ship-info").slideDown("slow", function() {

		  	$('.shipping_name').val('');
		  	$('.shipping_lastname').val('');
		  	$('.shipping_address').val('');
		  	$('.shipping_address_two').val('');
            $('.shipping_state').val('');
		  	$('.shipping_city').val('');
		  	$('.shipping_email').val('');
		  	$('.shipping_phone').val('');		  	

		  });
	}).change(); //ensure visible state matches initially

 	$('a[href^="#"]').on('click',function (e) {
    	e.preventDefault();

    	var target = this.hash;
    	var $target = $(target);

	    $('html, body').stop().animate({
	      	'scrollTop': $target.offset().top
		}, 900, 'swing', function () {
			window.location.hash = target;
  		});
	});

  	$(".navbar-nav li a").click(function(event) {
    	$(".navbar-collapse").collapse('hide');
  	});

	$( ".help" ).click (function() {
		if ($(this).html() == "x") {
			$( this ).html( "?" );
		} else {
		 $( this ).html( "x" );
		}
	});

	/* Login window / Nav mobile toggle */
    var $loginWindow = $('.login-window');
    var $loginForm = $loginWindow.find('.login');
    var $signupForm = $loginWindow.find('.signup');


	// Show the login form
    $('.login-toggle').on('click', function(e) {
        e.preventDefault();
        /*$('html, body').stop().animate({
          'scrollTop': 0
          }, 900, 'swing', function () {
        });*/ 
        $loginForm.show();
        $loginWindow.velocity('fadeIn', {
            complete: function() {
                $('body').addClass('no-scroll');
            }
        });

        // Prevent scrolling
        document.ontouchmove = function(e) { 
            e.preventDefault(); 
        };

        // Add login hash URL
        window.location.hash = 'login';
    });

    // Show the signup form
    $('.signup-toggle').on('click', function(e) {
        e.preventDefault();
        /*$('html, body').stop().animate({
          'scrollTop': 0
          }, 900, 'swing', function () {
        }); */
        $signupForm.show();
        $loginWindow.velocity('fadeIn', {
            complete: function() {
                $('body').addClass('no-scroll');
            }
        });

        // Prevent scrolling
        document.ontouchmove = function(e) { 
            e.preventDefault(); 
        };

        // Add signup hash URL
        window.location.hash = 'signup';
    });
    
    $('.login-window button.close').on('click', function(e) {
        e.preventDefault();

        $loginWindow.velocity('fadeOut', {
            complete: function() {
                $('body').removeClass('no-scroll');
            }
        });
        $loginForm.hide();
        $signupForm.hide();

        // Reenable scrolling
        document.ontouchmove = function() {
            return true; 
        };

        // Remove hash URL
        window.location.hash = '';
    });

    /* Login window hash URL stuff */
    // If the page is loading with a hash
    if(window.location.hash) {
        // Puts hash in variable
        var hash = window.location.hash;
        
        if( hash === '#login' ) {
            $loginForm.show();
            $loginWindow.velocity('fadeIn', {
                complete: function() {
                    $('body').addClass('no-scroll');
                }
            });

        } else if( hash === '#signup' ) {
            $signupForm.show();
            $loginWindow.velocity('fadeIn', {
                complete: function() {
                    $('body').addClass('no-scroll');
                }
            });

        }
    }

});