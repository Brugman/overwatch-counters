(function() {

    let heroes = document.querySelector('.heroes');
    let hero_items = document.querySelectorAll('.hero');

    hero_items.forEach(function ( hero ) {
        hero.addEventListener('click', function ( event ) {
            let this_hero = event.currentTarget;
            // prevent default
            event.stopPropagation();
            event.preventDefault();
            // if we neutralize
            let neutralize = false;
            if ( this_hero.classList.contains('active-select') )
            {
                neutralize = true;
                heroes.classList.add('neutral');
            }
            // remove all actives
            hero_items.forEach(function (hero_item) {
                hero_item.classList.remove('active-select', 'active-counter');
            });
            // if we dont neutralize
            if ( !neutralize ) 
            {
                heroes.classList.remove('neutral');
                // set this obs active
                this_hero.classList.add('active-select');
                // get counters
                let is_countered_by = this_hero.dataset.isCounteredBy.split('|');
                // set counters active
                is_countered_by.forEach(function(counter_name){
                    let counter_hero = document.querySelector( '.hero-'+counter_name );
                    if (counter_hero) {
                        counter_hero.classList.add('active-counter');
                    }
                });
            }
        });
    });

})();
