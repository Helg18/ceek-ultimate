;( function( $, window, undefined ) {
    'use strict';

    var slugy = {

		 title : $('#title'),
         slug : $('#slug'),

        init : function() {

            if ( !$('form').hasClass('edit') ) {

                slugy.title.on('keyup', function () {
                    var val = $(this).val();
                    val = val.toLowerCase().replace(/ /g, '-').replace(/[^a-z0-9_\-]/g, '');
                    slugy.slug.val(val);
                });
            }

            slugy.slug.on('focusout', function () {
                var val = $(this).val();
                val = val.toLowerCase().replace(/ /g, '-').replace(/[^a-z0-9_\-]/g, '');
                slugy.slug.val(val);
            });
        }
    };

slugy.init();

}( jQuery, this ) );