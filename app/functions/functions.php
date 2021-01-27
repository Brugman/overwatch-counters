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

function load_config()
{
    $config_example = dirname( dirname( __FILE__ ) ).'/config.example.php';
    $config         = dirname( dirname( __FILE__ ) ).'/config.php';

    if ( !file_exists( $config ) )
        copy( $config_example, $config );

    require $config;
}

function display_as_table( $data )
{
    echo '<table>';
    foreach ( $data as $row )
    {
        echo '<tr>';
        foreach ( $row as $cell )
        {
            echo '<td>'.$cell.'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function convert_to_array( $data )
{
    $data = str_getcsv( $data, "\n" );

    foreach ( $data as &$row )
        $row = str_getcsv( $row );

    return $data;
}

function get_heroes( $data, $type = false )
{
    if ( $type == 'damage' )
        return array_slice( $data[1], 2, 17 );

    if ( $type == 'tank' )
        return array_slice( $data[1], 19, 8 );

    if ( $type == 'support' )
        return array_slice( $data[1], 27, 7 );

    return array_slice( $data[1], 2 );
}

function get_hero_name_by_index( $data, $hero_id )
{
    return $data[ $hero_id ][1];
}

function heroes_strong_against( $data, $hero_id )
{
    $counters = [];

    $hero_row = $data[ $hero_id +2 ];

    foreach ( $hero_row as $counter_index => $wl )
        if ( $wl == 'L' )
            $counters[] = get_hero_name_by_index( $data, $counter_index );

    $hero_col = array_column( $data, $hero_id +2 );

    foreach ( $hero_col as $counter_index => $wl )
        if ( $wl == 'W' )
            $counters[] = get_hero_name_by_index( $data, $counter_index );

    return $counters;
}

function slugify_name( $name )
{
    return str_replace( [' ','.'], '', strtolower( $name ) );
}

function get_source_data( $gsheet_url = false )
{
    if ( !$gsheet_url || empty( $gsheet_url ) )
        $gsheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSecW57HwpBfbcivjEPGWkVD6iP-tDj13JbWDt1oAA6f7JYaGoRRVKswyyjPCXJ2KRITFmcvxflBa-0/pub?gid=0&single=true&output=csv';

    $source_csv = @file_get_contents( $gsheet_url );

    if ( !$source_csv )
        return [ false, 'Source data could not be loaded.' ];

    $source_data = convert_to_array( $source_csv );

    if ( !in_array( $source_data[3][2], ['W','L'] ) )
        return [ false, 'Google Sheets data has not properly saved.' ];

    return [ true, $source_data ];
}

function pipeify( $array = [] )
{
    if ( empty( $array ) )
        return '';

    foreach ( $array as &$item )
        $item = slugify_name( $item );

    return implode( '|', $array );
}

function include_svg( $filename = false )
{
    if ( !$filename )
        return false;

    $path = '../public_html/assets/images/'.$filename.'.svg';

    if ( !file_exists( $path ) )
        return false;

    return file_get_contents( $path );
}

