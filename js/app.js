(function() {

    /**
     * Version Switcher.
     */

    // get buttons
    let game_version_buttons = document.querySelectorAll('.js-activate-game-version');
    // foreach button
    game_version_buttons.forEach( function ( button ) {
        // on click
        button.addEventListener( 'click', function ( event ) {
            // prevent default
            event.stopPropagation();
            event.preventDefault();
            // get clicked version
            let clicked_version = button.dataset.gameVersion;
            // get version contents
            let game_version_contents = document.querySelectorAll('.js-game-version');
            // foreach content
            game_version_contents.forEach( function ( content ) {
                // decide display value
                let display_value = ( content.dataset.gameVersion == clicked_version ? 'block' : 'none' );
                // set display value
                content.style.display = display_value;
            });
        });
    });

    /**
     * Display Counters.
     */

/*
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
*/

})();