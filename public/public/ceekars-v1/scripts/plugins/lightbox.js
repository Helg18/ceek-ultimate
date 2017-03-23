/*!
 * jquery.lightbox.js
 * https://github.com/duncanmcdougall/Responsive-Lightbox
 * Copyright 2013 Duncan McDougall and other contributors; @license Creative Commons Attribution 2.5
 *
 * Options:
 * margin - int - default 50. Minimum margin around the image
 * nav - bool - default true. enable navigation
 * blur - bool - default true. Blur other content when open using css filter
 * minSize - int - default 0. Min window width or height to open lightbox. Below threshold will open image in a new tab.
 *
 * Changes made by Carl C.
 * Changed from image to iframe lightbox to support video embedding.
 */
(function($) {

    'use strict';

    $.fn.Vlightbox = function(options) {

        var opts = {
            margin: 50,
            nav: true,
            blur: true,
            minSize: 0
        };

        var plugin = {

            items: [],
            lightbox: null,
            image: null,
            current: null,
            locked: false,
            caption: null,

            init: function(items) {
                plugin.items = items;
                plugin.selector = "lightbox-" + Math.random().toString().replace('.', '');

                if (!plugin.lightbox) {
                    $('body').append(
                        '<div id="lightbox" style="display:none;">' +
                        '<a href="#" class="lightbox-close lightbox-button"></a>' +
                        '<div class="lightbox-nav">' +
                        '<a href="#" class="lightbox-previous lightbox-button"></a>' +
                        '<a href="#" class="lightbox-next lightbox-button"></a>' +
                        '</div>' +
                        '<div href="#" class="lightbox-caption"><p></p></div>' +
                        '</div>'
                    );

                    plugin.lightbox = $("#lightbox");
                    plugin.caption = $('.lightbox-caption', plugin.lightbox);
                }

                if (plugin.items.length > 1 && opts.nav) {
                    $('.lightbox-nav', plugin.lightbox).show();
                } else {
                    $('.lightbox-nav', plugin.lightbox).hide();
                }

                plugin.bindEvents();

            },

            loadImage: function() {
                if (opts.blur) {
                    $("body").addClass("blurred");
                }
                $("iframe", plugin.lightbox).remove();
                plugin.lightbox.fadeIn('fast').append('<div class="lightbox-loading"><div id="floatingBarsG"><div class="blockG" id="rotateG_01"></div><div class="blockG" id="rotateG_02"></div><div class="blockG" id="rotateG_03"></div><div class="blockG" id="rotateG_04"></div><div class="blockG" id="rotateG_05"></div><div class="blockG" id="rotateG_06"></div><div class="blockG" id="rotateG_07"></div><div class="blockG" id="rotateG_08"></div></div></div>');



                /*function vid_sc($atts, $content=null) {
    			extract(
        shortcode_atts(array(
            'site' => 'youtube',
            'id' => '',
            'w' => '600',
            'h' => '370'
        ), $atts)
    );
    if ( $site == "youtube" ) { $src = 'http://www.youtube-nocookie.com/embed/'.$id; }
    else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id; }
    else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id; }
    else if ( $site == "yahoo" ) { $src = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$id; }
    else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
    else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id; }
    else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/simple/'.$id; }
    if ( $id != '' ) {
        return '<iframe width="'.$w.'" height="'.$h.'" src="'.$src.'" class="vid iframe-'.$site.'"></iframe>';
    }
}
add_shortcode('vid','vid_sc');*/




                var iframe = '<iframe width="1280" height="720" src="' + $(plugin.current).attr('href') + '?wmode=transparent" frameborder="0" allowfullscreen></iframe>'



                plugin.lightbox.append(iframe);
                plugin.image = $("iframe", plugin.lightbox).hide();
                plugin.resizeImage();
                plugin.setCaption();
                $('#lightbox iframe').load(function() {
                    $('.lightbox-loading').remove();


                });
            },

            setCaption: function() {
                var caption = $(plugin.current).data('caption');
                if (!!caption && caption.length > 0) {
                    plugin.caption.fadeIn();
                    $('p', plugin.caption).text(caption);
                } else {
                    plugin.caption.hide();
                }
            },

            resizeImage: function() {
                var ratio, wHeight, wWidth, iHeight, iWidth;
                wHeight = $(window).height() - opts.margin;
                wWidth = $(window).outerWidth(true) - opts.margin;
                plugin.image.width('').height('');
                iHeight = plugin.image.height();
                iWidth = plugin.image.width();
                if (iWidth > wWidth) {
                    ratio = wWidth / iWidth;
                    iWidth = wWidth;
                    iHeight = Math.round(iHeight * ratio);
                }
                if (iHeight > wHeight) {
                    ratio = wHeight / iHeight;
                    iHeight = wHeight;
                    iWidth = Math.round(iWidth * ratio);
                }

                plugin.image.width(iWidth).height(iHeight).css({
                    'top': ($(window).height() - plugin.image.outerHeight()) / 2 + 'px',
                    'left': ($(window).width() - plugin.image.outerWidth()) / 2 + 'px'
                }).show();
                plugin.locked = false;
            },

            getCurrentIndex: function() {
                return $.inArray(plugin.current, plugin.items);
            },

            next: function() {
                if (plugin.locked) {
                    return false;
                }
                plugin.locked = true;
                if (plugin.getCurrentIndex() >= plugin.items.length - 1) {
                    $(plugin.items[0]).click();
                } else {
                    $(plugin.items[plugin.getCurrentIndex() + 1]).click();
                }
            },

            previous: function() {
                if (plugin.locked) {
                    return false;
                }
                plugin.locked = true;
                if (plugin.getCurrentIndex() <= 0) {
                    $(plugin.items[plugin.items.length - 1]).click();
                } else {
                    $(plugin.items[plugin.getCurrentIndex() - 1]).click();
                }
            },

            bindEvents: function() {
                $(plugin.items).click(function(e) {
                    if (!$("#lightbox").is(":visible") && ($(window).width() < opts.minSize || $(window).height() < opts.minSize)) {
                        $(this).attr("target", "_blank");
                        return;
                    }
                    var self = $(this)[0];
                    e.preventDefault();
                    plugin.current = self;
                    plugin.loadImage();

                    // Bind Keyboard Shortcuts
                    $(document).on('keydown', function(e) {
                        // Close lightbox with ESC
                        if (e.keyCode === 27) {
                            plugin.close();
                        }
                        // Go to next image pressing the right key
                        if (e.keyCode === 39) {
                            plugin.next();
                        }
                        // Go to previous image pressing the left key
                        if (e.keyCode === 37) {
                            plugin.previous();
                        }
                    });
                });

                // Add click state on overlay background only
                plugin.lightbox.on('click', function(e) {
                    if (this === e.target) {
                        plugin.close();
                    }
                });

                // Previous click
                $(plugin.lightbox).on('click', '.lightbox-previous', function() {
                    plugin.previous();
                    return false;
                });

                // Next click
                $(plugin.lightbox).on('click', '.lightbox-next', function() {
                    plugin.next();
                    return false;
                });

                // Close click
                $(plugin.lightbox).on('click', '.lightbox-close', function() {
                    plugin.close();
                    return false;
                });

                $(window).resize(function() {
                    if (!plugin.image) {
                        return;
                    }
                    plugin.resizeImage();
                });
            },

            close: function() {
                $(document).off('keydown'); // Unbind all key events each time the lightbox is closed
                $(plugin.lightbox).fadeOut('fast');
                $(plugin.image).remove();
                $('body').removeClass('blurred');
            }
        };

        $.extend(opts, options);

        plugin.init(this);
    };

})(jQuery);