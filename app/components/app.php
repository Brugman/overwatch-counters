<?php

[ $success, $data ] = get_source_data();

if ( !$success )
{
    echo '<p class="error">'.$data.'</p>';
    return;
}

$heroes = get_heroes( $data, 'all' );

?>
<div class="wrapper">

    <ul class="heroes neutral">
<?php

foreach ( $heroes as $hero_id => $hero_name )
{
?>
        <li class="hero hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=pipeify( heroes_strong_against( $data, $hero_id ) );?>" title="<?=$hero_name;?>">
            <div class="inner" style="background-image: url('/assets/images/hero-<?=slugify_name( $hero_name );?>.png');">
                <p><?=$hero_name;?></p>
            </div><!-- inner -->
        </li><!-- hero -->
<?php
}

?>
    </ul><!-- heroes -->

</div><!-- wrapper -->

