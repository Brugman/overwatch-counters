<?php

[ $success, $data ] = get_ow1_data( APP_GSHEET_URL );

if ( !$success )
{
    echo '<p class="error">'.$data.'</p>';
    return;
}

?>

<ul>
    <li><a class="js-load-game-version" data-game-version="1" href="#" style="font-size: 20px;">OW1</a></li>
    <li><a class="js-load-game-version" data-game-version="2" href="#" style="font-size: 20px;">OW2</a></li>
</ul>

<div class="version-wrapper">

<div class="ow2-wrapper">

    <p>This is OW2 content.</p>

</div><!-- ow2 -->

<div class="ow1-wrapper" style="display: none;">

<div class="wrapper">
    <div class="wrapper-inner">

<?php foreach ( ['tank','damage','support'] as $role ): ?>

        <div class="role">

            <p class="title"><?=include_svg('icon-role-'.$role);?><?=ucfirst( $role );?></p>

            <ul class="heroes neutral">
<?php

foreach ( get_heroes( $data, $role ) as $hero_id => $hero_name )
{
?>
                <li class="hero hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data, $hero_id ) );?>" title="<?=$hero_name;?>">
                    <div class="inner">
                        <img src="/assets/images/hero-<?=slugify_name( $hero_name );?>.png" loading="eager" alt="<?=$hero_name;?>">
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

</div><!-- ow1 -->

</div>

