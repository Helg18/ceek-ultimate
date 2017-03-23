(function($){

    $(function() {

        /* Login window / Nav mobile toggle */
        var $loginWindow = $('.login-window');
        var $loginForm = $loginWindow.find('.login');
        var $signupForm = $loginWindow.find('.signup');

        var $navMobile = $('.nav-mobile');

        // Show the login form
        $('.login-toggle').on('click', function(e) {
            $('html, body').stop().animate({
              'scrollTop': 0
              }, 900, 'swing', function () {
            });            
            e.preventDefault();

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
            $('html, body').stop().animate({
              'scrollTop': 0
              }, 900, 'swing', function () {
            });             
            e.preventDefault();

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

        // Show the nav-mobile
        $('button.navbar-toggle').on('click', function(e) {
            e.preventDefault();

            $navMobile.velocity('fadeIn');

            // Prevent scrolling
            document.ontouchmove = function(e) { 
                e.preventDefault(); 
            };

            // Add login hash URL
            // window.location.hash = 'menu';
        });

        // Hide the nav-mobile
        $('.nav-mobile button.close').on('click', function(e) {
            e.preventDefault();

            $navMobile.velocity('fadeOut');

            // Reenable scrolling
            document.ontouchmove = function() {
                return true; 
            };

            // Remove hash URL
            window.location.hash = '';
        });

        $(document).keyup(function(e) {
            // If escape key is pressed
            if( e.keyCode === 27 && $loginWindow.is(':visible') ) {
                $loginWindow.velocity('fadeOut', {
                    complete: function() {
                        $('body').removeClass('no-scroll');
                    }
                });
                $loginForm.hide();
                $signupForm.hide();
                // Remove hash URL
                window.location.hash = '';
            } else if( e.keyCode === 27 && $navMobile.is(':visible') ) {
                $navMobile.velocity('fadeOut');
                // Remove hash URL
                window.location.hash = '';
            }
        });
        /***/

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
        /***/

        /* Reload page when anchor link is clicked */
        $('.nav-mobile ul').on('click', 'a', function() {
            if(window.location.hash) {
                location.reload();
            }
        });
        /***/

        /* Init Selectric JS */
        $('.selectric').selectric({
            onChange: function(element) {
                $(element).closest('.selectric-wrapper').addClass('changed-item');
            },
            disableOnMobile: false
        });

        // Append countries list data to select element dynamically
        $.get('list-countries.html', function(data) {
            $('select[name="signup-country"]').append(data).selectric();
        });

        // Append states list data to select element dynamically
        $.get('list-states.html', function(data) {
            $('select[name="signup-state"]').append(data).selectric();
        });
        /***/

        $('.image-picker').imagepicker({
            'show_label': true
        });

        /* Navigate between form fieldsets */
        var $form = $('#signup-form'),
            $nextButton = $form.find('.btn-next');

        $nextButton.on('click', function() {
            // Fade out the next button temporarily to avoid jumping
            $nextButton
                .add( $form.find('.step-counter') )
                .velocity('fadeOut');

            if ( $('button.close').is(':visible') ) {
                $('button.close').hide();
            }

            $form.find('fieldset:visible')
                .velocity('fadeOut', {
                    complete: function() {
                        // Widen the form
                        $('.login-window').addClass('wide-form');
                        // Go to the next fieldset
                        $(this)
                            .next().velocity('fadeIn');

                        // Hide the T&Cs notice
                        $form.find('p.notice').velocity('fadeOut');

                        // Change the button text and width
                        $nextButton
                            .addClass('btn-small')
                            .text('Next')
                            .add( $form.find('.step-counter') )
                            .velocity('fadeIn');

                        // If the step counter doesn't exist yet
                        if ( !$('.step-counter').length ) {
                            // Add a step counter for the fieldsets
                            var $stepCounter = $('<div class="step-counter"><span>1</span> of <span>3</span></div>');
                            $nextButton
                                // Disable for interests at first
                                .attr('disabled', 'disabled')
                                .addClass('disabled')
                                .after($stepCounter);

                        } else {
                            var $firstSpan = $('.step-counter').find('span').first();
                            // Get the current step
                            var currentStep = parseInt( $firstSpan.text() );
                            // Increment it
                            currentStep++;

                            // Change the text of the button
                            if ( currentStep === 3 ) {
                                $nextButton
                                    .attr('type', 'submit')
                                    .text('Finish');
                            }
                            if ( currentStep === 4 ) {
                                $('.step-counter').remove();
                                $nextButton.remove();
                            }
                            // Update the span
                            $firstSpan.text(currentStep++);
                        }
                    }
                });

        });
        /***/

        $('.image_picker_selector').on('click', '.thumbnail', function() {
            var $nextButton = $('#signup-form').find('.btn-next'),
                numInterests = $('.thumbnail.selected').length;

            if ( numInterests === 5 ) {
                $nextButton
                    .removeClass('disabled')
                    .removeAttr('disabled');
            } else if ( numInterests < 5 ) {
                $nextButton
                    .addClass('disabled')
                    .attr('disabled', 'disabled');
            }
        });

        /* Init noUISlider range sliders */
        // Init miles slider
        var mileRange = document.getElementById('mile-range');
        noUiSlider.create(mileRange, { // jshint ignore:line
            start: 100,
            range: {
                'min': 0,
                'max': 200
            },
            connect: 'lower',
            step: 10,
            pips: {
                mode: 'positions',
                values: [0,100],
                stepped: true
            },
            format: wNumb({ // jshint ignore:line
                decimals: 0,
            }),
        });

        // Update the mile span and range input
        mileRange.noUiSlider.on('set', function() {
            var miles = mileRange.noUiSlider.get();
            if ( miles === '200' ) {
                $('.mile-range-text').text('Everywhere');
            } else if ( $('.mile-range-text').text('Everywhere') ) {
                $('.mile-range-text').html('Within <span>' + miles + '</span> Miles of me');
            } else {
                $('.mile-range-text').find('span').text( miles );
            }
        });

        // Init age slider
        var ageRange = document.getElementById('age-range');
        noUiSlider.create(ageRange, { // jshint ignore:line
            start: [26, 39],
            range: {
                'min': 18,
                'max': 99
            },
            connect: true,
            format: wNumb({ // jshint ignore:line
                decimals: 0,
                postfix: ''
            })
        });

        // Update the age span and range input
        ageRange.noUiSlider.on('update', function() {
            // Get the array
            var ageRangeArr = ageRange.noUiSlider.get();

            var rangeString = $.map(ageRangeArr, function(value) {
                var string = value;
                return string;
            }).join(' - ');

            $('.age-range-text').find('span').text( rangeString );
        });

        // Change the range separator unit
        var ageRangeText = $('.age-range-text').find('span').text();
        ageRangeText = ageRangeText.replace(',', ' - ');
        $('.age-range-text').find('span').text( ageRangeText );
        /***/

        /* Init dropzone for photo upload */
        $("#upload-photo-zone").dropzone({ 
            url: "/file/post"
        });
        /***/

    }); // document.ready
       
})(jQuery);

