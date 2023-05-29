<div class="game-version js-game-version" data-game-version="2" style="<?=( ( $_COOKIE['active_version'] ?? 2 ) == 2 ? '' : 'display: none;' );?>">

<?php foreach ( ['tank','damage','support'] as $role ): ?>

    <div class="role role-<?=$role;?>">

        <p class="title"><?=include_svg('icon-role-'.$role);?><?=ucfirst( $role );?></p>

        <ul class="heroes js-heroes neutral">
<?php

foreach ( get_heroes_ow2( $data_ow2, $role ) as $hero_id => $hero_name )
{
?>
            <li class="hero js-hero js-hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data_ow2, $hero_id ) );?>" title="<?=$hero_name;?>">
                <picture>
                    <source srcset="https://cdn.overwatchcounters.com/assets/images/ow2/hero-<?=slugify_name( $hero_name );?>.webp?<?=asset_version();?>" type="image/webp">
                    <source srcset="https://cdn.overwatchcounters.com/assets/images/ow2/hero-<?=slugify_name( $hero_name );?>.png?<?=asset_version();?>" type="image/png">
                    <img src="https://cdn.overwatchcounters.com/assets/images/ow2/hero-<?=slugify_name( $hero_name );?>.png?<?=asset_version();?>" alt="<?=$hero_name;?>">
                </picture>
                <div class="name"><?=shorten_hero_name( $hero_name );?></div>
            </li><!-- hero -->
<?php
}

?>
        </ul><!-- heroes -->

    </div><!-- role -->

<?php endforeach; // $roles ?>

</div><!-- game-version -->

