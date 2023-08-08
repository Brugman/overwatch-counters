/**
 * Display Counters.
 */

let hero_groups = document.querySelectorAll('.js-game-version .js-heroes');
let hero_items = document.querySelectorAll('.js-game-version .js-hero');

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
            hero_groups.forEach( function ( hero_list ) {
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
            hero_groups.forEach( function ( hero_list ) {
                hero_list.classList.remove('neutral');
            });
            // set active hero
            this_hero.classList.add('active-select');
            // set active counters
            let is_countered_by = this_hero.dataset.isCounteredBy.split('|');
            is_countered_by.forEach( function ( counter_name ) {
                let counter_hero = document.querySelector( '.js-game-version .js-hero-'+counter_name );
                if ( counter_hero ) {
                    counter_hero.classList.add('active-counter');
                }
            });
        }
    });
});

