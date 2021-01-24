<?php

function d( $var )
{
    echo "<pre style=\"max-height:35vh;display:inline-block;z-index:9999;position:relative;overflow-y:scroll;white-space:pre-wrap;word-wrap:break-word;padding:10px 15px;border:1px solid #fff;background-color:#161616;text-align:left;line-height:1.5;font-family:Courier;font-size:16px;color:#fff;\">";
    print_r( $var );
    echo "</pre>";
}

function dd( $var )
{
    d( $var );
    exit;
}

function convert_to_array( $data )
{
    $data = str_getcsv( $data, "\n" );
    foreach ( $data as &$row )
        $row = str_getcsv( $row );
    return $data;
}

function get_heroes( $data )
{
    return array_slice( $data[1], 2 );
}

function filter_heroes( $heroes_all, $type = false )
{
    if ( !$type )
        return [];

    if ( $type == 'damage' )
        return array_slice( $heroes_all, 0, 16 );

    if ( $type == 'tank' )
        return array_slice( $heroes_all, 16, 8 );

    if ( $type == 'support' )
        return array_slice( $heroes_all, 24, 7 );
}

function get_hero_name_by_index( $hero_index )
{
    global $heroes_all;
    return $heroes_all[ $hero_index -2 ];
}

function heroes_strong_against( $hero_index )
{
    global $source_data;

    $counters = [];

    $hero_row = $source_data[ $hero_index +2 ];

    foreach ( $hero_row as $counter_index => $wl )
        if ( $wl == 'L' )
            $counters[] = get_hero_name_by_index( $counter_index );

    return $counters;
}

function heroes_neutral_against( $hero_index )
{
    global $source_data;

    $counters = [];

    $hero_row = $source_data[ $hero_index +2 ];

    foreach ( $hero_row as $counter_index => $wl )
        if ( $wl == 'N' )
            $counters[] = get_hero_name_by_index( $counter_index );

    return $counters;
}

function slugify_name( $name )
{
    $name = strtolower( $name );
    $name = str_replace( ' ', '-', $name );
    return $name;
}

