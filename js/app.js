(function($) {

    $('.hero').on( 'click', function ( event ) {
        // prevent default
        event.stopPropagation();
        event.preventDefault();
        // if we neutralize
        let neutralize = false;
        if ( $(this).hasClass('active-select') )
        {
            neutralize = true;
            $('.heroes').addClass('neutral');
        }
        // remove all actives
        $('.hero').removeClass('active-select');
        $('.hero').removeClass('active-counter');
        // if we dont neutralize
        if ( !neutralize )
        {
            $('.heroes').removeClass('neutral');
            // set this obs active
            $(this).addClass('active-select');
            // get counters
            let is_countered_by = $(this).data('is-countered-by').split('|');
            // set counters active
            $( is_countered_by ).each( function () {
                $( '.hero-'+this ).addClass('active-counter');
            });
        }
    });

})( jQuery );