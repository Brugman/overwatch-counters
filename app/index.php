<?php

include 'functions/functions.php';

include 'components/core-head.php';

$source_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSecW57HwpBfbcivjEPGWkVD6iP-tDj13JbWDt1oAA6f7JYaGoRRVKswyyjPCXJ2KRITFmcvxflBa-0/pub?gid=0&single=true&output=csv';
$source_csv = file_get_contents( $source_url );
$source_data = convert_to_array( $source_csv );

if ( !in_array( $source_data[2][3], ['W','L','#NAME?'] ) )
    d( 'Google Sheets data has not properly saved.' );

$heroes_all     = get_heroes( $source_data );
$heroes_damage  = filter_heroes( $heroes_all, 'damage' );
$heroes_tank    = filter_heroes( $heroes_all, 'tank' );
$heroes_support = filter_heroes( $heroes_all, 'support' );

?>

<ul class="heroes neutral">

<?php

foreach ( $heroes_damage as $hero_index => $hero_name )
{
    $counters = heroes_strong_against( $hero_index );

    $counters_piped = '';
    foreach ( $counters as $counter )
        $counters_piped .= '|'.slugify_name( $counter );
    $counters_piped = substr( $counters_piped, 1 );

    $neutrals = heroes_neutral_against( $hero_index );
?>

    <li class="hero hero-<?=slugify_name( $hero_name );?>" data-is-countered-by="<?=$counters_piped;?>" title="<?=$hero_name;?>">
        <div class="inner" style="background-image: url('/assets/images/hero-<?=slugify_name( $hero_name );?>.png');">
            <?=$hero_name;?>
        </div>
    </li>

<?php
}

?>

</ul>

<?php

include 'components/core-foot.php';

