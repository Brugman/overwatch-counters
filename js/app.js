(function() {

    console.log( 'version 1' );

    var heroes = document.querySelector('.heroes');
    var hero_items = document.querySelectorAll('.hero');

    hero_items.forEach(function ( hero ) {
        hero.addEventListener('click', function ( event ) {
            // prevent default
            event.stopPropagation();
            event.preventDefault();
            //
            var this_hero = event.currentTarget;
            var neutralize = false;
            if ( this_hero.classList.contains('active-select') ) {
                neutralize = true;
                heroes.classList.add('neutral');
            }
            // remove all actives
            hero_items.forEach(function (hero_item) {
                hero_item.classList.remove('active-select', 'active-counter');
            })
            //
            if ( !neutralize ) {
                heroes.classList.remove('neutral');
                // set this obs active
                this_hero.classList.add('active-select');
                // get counters
                var is_countered_by = this_hero.dataset.isCounteredBy.split('|');
                is_countered_by.forEach(function(counter_name){
                    // set counters active
                    var counter_hero = document.querySelector( '.hero-'+counter_name );
                    if (counter_hero) {
                        counter_hero.classList.add('active-counter');
                    }
                });
            }
        });
    });

})();
