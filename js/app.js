(function() {

    //
    // data-game-version

    let qwe = document.getElementsByClassName( 'js-load-game-version' );

    qwe.addEventListener( 'click', function ( event ) {
        // prevent default
        event.stopPropagation();
        event.preventDefault();
        console.log( '----' );
        console.log( 'you clicked!' );
    });

    let hero_lists = document.querySelectorAll('.heroes');
    let hero_items = document.querySelectorAll('.hero');

    hero_items.forEach( function ( hero ) {
        hero.addEventListener( 'click', function ( event ) {
            // prevent default
            event.stopPropagation();
            event.preventDefault();
            // variables
            let this_hero = event.currentTarget;
            let neutralize = false;
            // if we neutralize
            if ( this_hero.classList.contains('active-select') ) {
                neutralize = true;
                // add neutral state
                hero_lists.forEach( function ( hero_list ) {
                    hero_list.classList.add('neutral');
                });
            }
            // remove all actives
            hero_items.forEach( function ( hero_item ) {
                hero_item.classList.remove('active-select', 'active-counter');
            });
            // if we dont neutralize
            if ( !neutralize ) {
                // remove neutral state
                hero_lists.forEach( function ( hero_list ) {
                    hero_list.classList.remove('neutral');
                });
                // set active hero
                this_hero.classList.add('active-select');
                // set active counters
                let is_countered_by = this_hero.dataset.isCounteredBy.split('|');
                is_countered_by.forEach( function ( counter_name ) {
                    let counter_hero = document.querySelector( '.hero-'+counter_name );
                    if ( counter_hero ) {
                        counter_hero.classList.add('active-counter');
                    }
                });
            }
        });
    });

})();