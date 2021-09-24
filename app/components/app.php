<?php

[ $success, $data ] = get_data( APP_GSHEET_URL );

if ( !$success )
{
    echo '<p class="error">'.$data.'</p>';
    return;
}

$roles = ['tank','damage','support'];

?>
<div class="wrapper">
    <div class="wrapper-inner">

<?php foreach ( $roles as $role ): ?>

        <div class="role">

            <p class="title"><?=include_svg('icon-role-'.$role);?><?=ucfirst( $role );?></p>

            <ul class="heroes neutral">
<?php

foreach ( get_heroes( $data, $role ) as $hero_id => $hero_name )
{
?>
                <li class="hero hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data, $hero_id ) );?>" title="<?=$hero_name;?>">
                    <div class="inner">
                        <img src="/assets/images/hero-<?=slugify_name( $hero_name );?>.png" loading="lazy" alt="<?=$hero_name;?>">
                    </div><!-- inner -->
                </li><!-- hero -->
<?php
}

?>
            </ul><!-- heroes -->

        </div><!-- role -->

<?php endforeach; // $roles ?>

    </div><!-- wrapper-inner -->
</div><!-- wrapper -->

