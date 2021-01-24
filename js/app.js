(function($) {

    console.log( 'version 1' );

    $('.hero').on( 'click', function ( event ) {
        // prevent default
        event.stopPropagation();
        event.preventDefault();
        //
        var neutralize = false;
        if ( $(this).hasClass('active-select') ) {
            var neutralize = true;
            $('.heroes').addClass('neutral');
        }
        // remove all actives
        $('.hero').removeClass('active-select');
        $('.hero').removeClass('active-counter');
        //
        if ( !neutralize ) {
            $('.heroes').removeClass('neutral');
            // set this obs active
            $(this).addClass('active-select');
            // get counters
            var is_countered_by = $(this).data('is-countered-by').split('|');
            $( is_countered_by ).each(function(){
                // set counters active
                $( '.hero-'+this ).addClass('active-counter');
            });
        }
    });

})( jQuery );