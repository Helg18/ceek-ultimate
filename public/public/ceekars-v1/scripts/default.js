// JavaScript Document
jQuery.noConflict();
// mobile form input zoom disable
window.inputZoomDisable = function($) {
    $("input, textarea, select").on({
        'focus': function() {
            zoomDisable($);
        }
    });
    $("input, textarea, select").on({
        'blur': function() {
            setTimeout(zoomEnable($), 10);
        }
    });
}

function zoomDisable($) {
    $('head meta[name=viewport]').remove();
    $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />');
}

function zoomEnable($) {
    $('head meta[name=viewport]').remove();
    $('head').prepend('<meta content="width=device-width, initial-scale=1,  user-scalable=1" name="viewport" />');
}

function resizeIt(wrapper) {
    var theWinsize = jQuery(wrapper).width();
    var thefontSize = ((theWinsize * 0.3125) / 2)
    thefontSize = thefontSize / 10
    if (thefontSize > 4.999 && thefontSize < 10.001) {
        jQuery('html,body').css("font-size", thefontSize)
    }
    if (thefontSize < 4.999) {
        jQuery('html,body').css("font-size", 5);
    }
    if (thefontSize > 10.001) {
        jQuery('html,body').css("font-size", 10);
    }
    if (window.innerWidth > 1340.01) {
        jQuery('.max .scaleMe').css("font-size", '10px');
        jQuery('.scaleMe').not('.max .scaleMe').css("font-size", thefontSize * 0.47);
        jQuery('.scaleMeLg').not('.max .scaleMe').css("font-size", thefontSize * 0.47);
    } else if (window.innerWidth > 640.01 && window.innerWidth < 1340.01) {
        jQuery('.scaleMe').css("font-size", thefontSize * 0.47);
    } else if (window.innerWidth < 640.01) {
        jQuery('.scaleMe').removeAttr('style');
    }
    if (window.innerWidth > 1024.01 && window.innerWidth < 1340.01) {
        jQuery('.scaleMeLg').css("font-size", thefontSize * 0.47);
    } else if (window.innerWidth < 1024.01) {
        jQuery('.scaleMeLg').removeAttr('style');
    }

}
window.onload = function() {
    resizeIt('#mainWrap')
}; //scrollbar?


jQuery(document).ready(function($) {
    $('a[rel="blank"]').click(function() {
        this.target = "_blank";
    });
    // font resizer
    resizeIt('#mainWrap');
    $('body').addClass('freeScale');
    $(window).resize(function() {
        resizeIt('#mainWrap');
    });
    //mobile menu + newsletter close
    $('#mainMenuBtn a').on("click", function(e) {
        if ($(this).is('.newsOpen #mainMenuBtn a')) {
            $('#mainHeader').toggleClass('newsOpen');
            $('#mainMenuBtn .close').toggleClass('hidden');
            $('#mainMenuBtn .open').toggleClass('hidden');
            $('#mainLogo .overLogo').toggleClass('hidden');
        } else {
            $('#mainHeader').toggleClass('menuOpen');
            $('#mainMenuBtn .close').toggleClass('hidden');
            $('#mainMenuBtn .open').toggleClass('hidden');
            $('#mainLogo .overLogo').toggleClass('hidden');
        }
        e.preventDefault();
    });
    //mobile newsletter open
    $('a.getUpdates').on("click", function(e) {
        $('#mainHeader').toggleClass('newsOpen');
        if (window.innerWidth < 641) {
            $('#mainHeader').toggleClass('menuOpen');
        }
        e.preventDefault();
    });
    //mobile quick tabs
    $('#mainSpecs  .tabs a').on("click", function(e) {
        if (window.innerWidth < 1024.1) {
            if (!($(this).is('.cur a').length)) {
                var theTab = $(this).attr('href');
                $('#mainSpecs .tabs li').removeClass('cur');
                $(this).parent().addClass('cur');
                $('.tabCont #tab1, .tabCont #tab2').hide();
                $('.tabCont ' + theTab).show();
            }
        }
        e.preventDefault();
    });
    //desktop menu show on scroll
    var scrollPos = $(window).scrollTop();
    if (window.innerWidth < 641) {
        if (scrollPos > 20) {
            $("#mainHeader").addClass('showMobileDown');
        }
    }

    $(window).scroll(function() {
        if ($('#mainAwakenWrp').length) {
            scrollPos = $(window).scrollTop();
            if (window.innerWidth > 640) {
                var theoff = $('#mainAwakenWrp').offset().top;
                if (scrollPos > (theoff/2)) {
                    $("#mainHeader").addClass('showDown')
                    $('#mainNav').css('overflow', 'visible');
                } else if (scrollPos < (theoff/2)) {
                    $("#mainHeader").removeClass('showDown');
                    $('#mainNav').css('overflow', 'hidden')
                }
            } else {
                //header mobile bg on scroll
                if (scrollPos > 20) {
                    $("#mainHeader").addClass('showMobileDown');
                } else {
                    $(".showMobileDown").removeClass('showMobileDown');
                };
            }
        }
    });
    // close newsletter desktop
    $('#newsTop .fa-times').on("click", function(e) {
        $('#mainHeader').toggleClass('newsOpen');
        e.preventDefault();
    });
    //nav page scroller
    $('#mainNav .bg ul a').not('a.getUpdates, a.noScroll').click(function(e) {
        if (window.innerWidth < 641) {
            $('#mainHeader').toggleClass('menuOpen');
            $('#mainMenuBtn .close').toggleClass('hidden');
            $('#mainMenuBtn .open').toggleClass('hidden');
            $('#mainLogo .overLogo').toggleClass('hidden');
        }
        var speedo = parseInt($('body').offset().top);
        var theLoc = $(this).attr('href');
        var theLocOff = $(theLoc).offset().top;
        speedo = theLocOff - speedo
        $("html:not(:animated),body:not(:animated)").animate({
            scrollTop: theLocOff - 110
        }, (speedo / 5) + 200, 'easeOutQuart', function() {        
        });
		//e.preventDefault
		return false;
    });
	$("#mainNav ul .extra").click( function(e){
		e.preventDefault();
	})
    //video gallery lightbox
    if ($('#mainVidTmbsList ul').length) {
        $('#mainVidTmbsList ul li h5 a').Vlightbox();
		$('#mainVidTmbsList ul li a.tmb').Vlightbox();//diff group
    }
});