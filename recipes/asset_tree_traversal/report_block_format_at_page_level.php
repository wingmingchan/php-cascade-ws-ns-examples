<?php
$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

// to prevent time-out
set_time_limit( 10000 );
// to prevent using up memory when traversing a large site
ini_set( 'memory_limit', '2048M' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $folder_id = "344fc19c8b7f08560135b47c44323f94";
    $results   = array();
    
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreeReportPageWithPageLevelBlockFormat" ) ),
            NULL,
            $results
        );
    
    u\DebugUtility::dump( $results );
    
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
} 
?>