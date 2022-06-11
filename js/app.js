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
        // set version on body for styling
        document.querySelector('body').dataset.gameVersion = clicked_version;
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

let ow1_hero_groups = document.querySelectorAll('.js-game-version[data-game-version="1"] .js-heroes');
let ow1_hero_items = document.querySelectorAll('.js-game-version[data-game-version="1"] .js-hero');

ow1_hero_items.forEach( function ( hero ) {
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
            ow1_hero_groups.forEach( function ( hero_list ) {
                hero_list.classList.add('neutral');
            });
        }
        // remove all actives
        ow1_hero_items.forEach( function ( hero_item ) {
            hero_item.classList.remove('active-select', 'active-counter');
        });
        // if we dont neutralize
        if ( !neutralize ) {
            // remove neutral state
            ow1_hero_groups.forEach( function ( hero_list ) {
                hero_list.classList.remove('neutral');
            });
            // set active hero
            this_hero.classList.add('active-select');
            // set active counters
            let is_countered_by = this_hero.dataset.isCounteredBy.split('|');
            is_countered_by.forEach( function ( counter_name ) {
                let counter_hero = document.querySelector( '.js-game-version[data-game-version="1"] .js-hero-'+counter_name );
                if ( counter_hero ) {
                    counter_hero.classList.add('active-counter');
                }
            });
        }
    });
});

let ow2_hero_groups = document.querySelectorAll('.js-game-version[data-game-version="2"] .js-heroes');
let ow2_hero_items = document.querySelectorAll('.js-game-version[data-game-version="2"] .js-hero');

ow2_hero_items.forEach( function ( hero ) {
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
            ow2_hero_groups.forEach( function ( hero_list ) {
                hero_list.classList.add('neutral');
            });
        }
        // remove all actives
        ow2_hero_items.forEach( function ( hero_item ) {
            hero_item.classList.remove('active-select', 'active-counter');
        });
        // if we dont neutralize
        if ( !neutralize ) {
            // remove neutral state
            ow2_hero_groups.forEach( function ( hero_list ) {
                hero_list.classList.remove('neutral');
            });
            // set active hero
            this_hero.classList.add('active-select');
            // set active counters
            let is_countered_by = this_hero.dataset.isCounteredBy.split('|');
            is_countered_by.forEach( function ( counter_name ) {
                let counter_hero = document.querySelector( '.js-game-version[data-game-version="2"] .js-hero-'+counter_name );
                if ( counter_hero ) {
                    counter_hero.classList.add('active-counter');
                }
            });
        }
    });
});

