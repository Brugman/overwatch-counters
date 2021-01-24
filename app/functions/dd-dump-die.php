<?php

/**
 * Dump.
 */

if ( !function_exists( 'd' ) )
{
    function d( $var )
    {
        echo "<pre style=\"max-height:35vh;display:inline-block;z-index:9999;position:relative;overflow-y:scroll;white-space:pre-wrap;word-wrap:break-word;padding:10px 15px;border:1px solid #fff;background-color:#161616;text-align:left;line-height:1.5;font-family:Courier;font-size:16px;color:#fff;\">";
        print_r( $var );
        echo "</pre>";
    }
}

if ( !function_exists( 'dump' ) )
{
    function dump( $var )
    {
        d( $var );
    }
}

/**
 * Dump & die.
 */

if ( !function_exists( 'dd' ) )
{
    function dd( $var )
    {
        d( $var );
        exit;
    }
}

