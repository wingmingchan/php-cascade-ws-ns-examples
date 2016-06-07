<?php
/*
This program shows how to use the Report class to report
pages in a folder containing long titles.
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
    $site_name   = 'cascade-admin';
    $folder_path = 'projects/web-services/oop/classes/asset-tree';
    
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        );

    u\DebugUtility::dump( $report->reportLongTitle( 15, a\Page::TYPE, true ) );

    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
?>