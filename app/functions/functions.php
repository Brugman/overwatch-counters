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

function asset_version()
{
    return 'v221005-1';
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

function get_heroes_ow1( $data, $type = false )
{
    if ( $type == 'damage' )
        return array_slice( $data[1], 2, 17, true );

    if ( $type == 'tank' )
        return array_slice( $data[1], 19, 8, true );

    if ( $type == 'support' )
        return array_slice( $data[1], 27, 7, true );

    return array_slice( $data[1], 2, null, true );
}

function get_heroes_ow2( $data, $type = false )
{
    if ( $type == 'damage' )
        return array_slice( $data[1], 2, 17, true );

    if ( $type == 'tank' )
        return array_slice( $data[1], 19, 11, true );

    if ( $type == 'support' )
        return array_slice( $data[1], 30, 10, true );

    return array_slice( $data[1], 2, null, true );
}

function get_hero_name_by_index( $data, $hero_id )
{
    return $data[ $hero_id ][1];
}

function heroes_strong_against( $data, $hero_id )
{
    $counters = [];

    $hero_row = $data[ $hero_id ];

    foreach ( $hero_row as $counter_index => $wl )
        if ( $wl == '1' )
            $counters[] = get_hero_name_by_index( $data, $counter_index );

    $hero_col = array_column( $data, $hero_id );

    foreach ( $hero_col as $counter_index => $wl )
        if ( $wl == '5' )
            $counters[] = get_hero_name_by_index( $data, $counter_index );

    return $counters;
}

function slugify_name( $name )
{
    return str_replace( [' ','.'], '', strtolower( $name ) );
}

function cache_file()
{
    return dirname( __DIR__ ).'/cache/cache.json';
}

function get_live_data_ow1()
{
    $gsheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSBY-rl90LKc2sv1nZCpwpkRhSoczelOsBe-Uhs9UH_b_TILDDak1Vvbh3HkMjn0vO5xet8bnmGSiHe/pub?gid=0&single=true&output=csv';

    if ( defined('APP_GSHEET_URL_OW1') && !empty( APP_GSHEET_URL_OW1 ) )
        $gsheet_url = APP_GSHEET_URL_OW1;

    return @file_get_contents( $gsheet_url );
}

function get_live_data_ow2()
{
    $gsheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSBY-rl90LKc2sv1nZCpwpkRhSoczelOsBe-Uhs9UH_b_TILDDak1Vvbh3HkMjn0vO5xet8bnmGSiHe/pub?gid=1367246486&single=true&output=csv';

    if ( defined('APP_GSHEET_URL_OW2') && !empty( APP_GSHEET_URL_OW2 ) )
        $gsheet_url = APP_GSHEET_URL_OW2;

    return @file_get_contents( $gsheet_url );
}

function get_cached_data()
{
    if ( !file_exists( cache_file() ) )
        return false;

    $data_json = file_get_contents( cache_file() );

    return json_decode( $data_json, true );
}

function set_cached_data( $data )
{
    $data_json = json_encode([
        'timestamp' => time(),
        'data'      => $data,
    ]);

    file_put_contents( cache_file(), $data_json );
}

function get_data()
{
    // get cached data
    $cached_data = get_cached_data();

    if ( $cached_data && $cached_data['timestamp'] > ( time() - 60*60*24 ) )
        return [ true, $cached_data['data']['ow1'], $cached_data['data']['ow2'] ];

    // get live data
    $live_data_ow1_csv = get_live_data_ow1();
    $live_data_ow2_csv = get_live_data_ow2();

    if ( !$live_data_ow1_csv || !$live_data_ow2_csv )
        return [ false, 'Data could not be loaded.', '' ];

    // convert csv
    $live_data_ow1 = convert_to_array( $live_data_ow1_csv );
    $live_data_ow2 = convert_to_array( $live_data_ow2_csv );

    if ( !in_array( $live_data_ow1[3][2], ['5','4','3','2','1'] ) )
        return [ false, 'Data was not properly saved.', '' ];
    if ( !in_array( $live_data_ow2[3][2], ['5','4','3','2','1'] ) )
        return [ false, 'Data was not properly saved.', '' ];

    // set new cache
    set_cached_data( [ 'ow1' => $live_data_ow1, 'ow2' => $live_data_ow2 ] );

    return [ true, $live_data_ow1, $live_data_ow2 ];
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

function shorten_hero_name( $name )
{
    $list = [
        'Wrecking Ball' => 'Ball',
        'Widowmaker' => 'Widow',
        // 'Reinhardt' => 'Rein',
        // 'Symmetra' => 'Sym',
        // 'Torbjorn' => 'Torb',
        'Junker Queen' => 'JQ',
    ];

    if ( isset( $list[ $name ] ) )
        return $list[ $name ];

    return $name;
}

