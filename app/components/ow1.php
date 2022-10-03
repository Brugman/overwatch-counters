<div class="game-version js-game-version" data-game-version="1" style="<?=( ( $_COOKIE['active_version'] ?? 2 ) == 1 ? '' : 'display: none;' );?>">

<?php foreach ( ['tank','damage','support'] as $role ): ?>

        <div class="role">

            <p class="title"><?=include_svg('icon-role-'.$role);?><?=ucfirst( $role );?></p>

            <ul class="heroes js-heroes neutral">
<?php

foreach ( get_heroes_ow1( $data_ow1, $role ) as $hero_id => $hero_name )
{
?>
                <li class="hero js-hero js-hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data_ow1, $hero_id ) );?>" title="<?=$hero_name;?>">
                    <div class="inner">
                        <img src="/assets/images/ow1/hero-<?=slugify_name( $hero_name );?>.png" loading="lazy" alt="<?=$hero_name;?>">
                    </div><!-- inner -->
                </li><!-- hero -->
<?php
}

?>
            </ul><!-- heroes -->

        </div><!-- role -->

<?php endforeach; // $roles ?>

</div><!-- game-version -->

