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

// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
	if( $(window).width() > 767) {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
		} else {
			$(".navbar-fixed-top").addClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
		}
  } else {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
  }
});


// pageloader
$(window).load(function(){
	if($(".preloader").length > 0){
		$('.preloader').fadeOut(1000);
	}
	if( $(window).width() > 767) {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
		} else {
			$(".navbar-fixed-top").addClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
		}
  } else {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
  }
});

$(window).resize(function(){
	if( $(window).width() > 767) {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
		} else {
			$(".navbar-fixed-top").addClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-white.svg");
		}
  } else {
			$(".navbar-fixed-top").removeClass("navbar-transparent");
			$(".navbar-brand img").attr("src", "/public/ceek-v3/img/ceek-blue.svg");
  }
});


$(function() {
	$('[data-toggle="popover"]').popover();

	$(".address").change(function(){
		// make sure of the checked state...
		// hide the fields if the checkbox is checked...
		// 'this' is the checkbox...
		if ($(this).is(":checked")) // fixed error here! ;)
		  $(".ship-info").slideUp("slow");
		else
		  $(".ship-info").slideDown("slow");
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
	})

});
