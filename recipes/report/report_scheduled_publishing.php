<?php
/*
This program can be used to report sites and publish set scheduled to be published
regularly.
*/

$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as     a;
use cascade_ws_property as  p;
use cascade_ws_utility as   u;
use cascade_ws_exception as e;

try
{
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );
    
    $results = $report->reportScheduledPublishing();
    
    u\DebugUtility::dump( $results );
   
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( Exception $e )
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
?>