<?php

[ $success, $data ] = get_data();

if ( !$success )
{
    echo '<p class="error">'.$data_ow1.'</p>';
    return;
}

?>

<div class="game-version js-game-version">

<?php foreach ( ['tank','damage','support'] as $role ): ?>

    <div class="role role-<?=$role;?>">

        <p class="title"><?=include_svg('icon-role-'.$role);?><?=ucfirst( $role );?></p>

        <ul class="heroes js-heroes neutral">
<?php

foreach ( get_heroes( $data, $role ) as $hero_id => $hero_name )
{
?>
            <li class="hero js-hero js-hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data, $hero_id ) );?>" title="<?=$hero_name;?>">
                <picture>
                    <source srcset="<?=cdn_if_cdn();?>/assets/images/hero-<?=slugify_name( $hero_name );?>.webp?<?=asset_version();?>" type="image/webp">
                    <source srcset="<?=cdn_if_cdn();?>/assets/images/hero-<?=slugify_name( $hero_name );?>.png?<?=asset_version();?>" type="image/png">
                    <img src="<?=cdn_if_cdn();?>/assets/images/hero-<?=slugify_name( $hero_name );?>.png?<?=asset_version();?>" alt="<?=$hero_name;?>">
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

