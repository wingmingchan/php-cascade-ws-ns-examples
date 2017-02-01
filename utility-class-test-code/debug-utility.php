<?php 
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    u\DebugUtility::dump( $service );
    u\DebugUtility::out( "Hello" );
    u\DebugUtility::outputDuration( $start_time );

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_utility\DebugUtility", true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>