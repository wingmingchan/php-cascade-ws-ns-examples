<?php
/*
This program can take a very long time to run.
*/
$start_time = time();

require_once( 'cascade_ws_ns/auth_chanw.php' );

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

// site to be traverse
$site_name = "cascade-admin"; // 636 seconds
$folder_id = "1e640d568b7f08ee4bf672732f23b0d5";

try
{
    $results = array();
    
    //$cascade->getSite( $site_name )->getBaseFolderAssetTree()->
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse(
            array( a\Page::TYPE =>      array( "assetTreeReportPhantomNodes" ),
                   a\DataBlock::TYPE => array( "assetTreeReportPhantomNodes" ) ),
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


function assetTreeReportPhantomNodes( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    if( !isset( $results ) || !is_array( $results ) )
        throw new \Exception( "The results array is required" );

    $type = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataBlock::TYPE )
        return;
        
    if( !isset( $results[ $type ] ) )
        $results[ $type ] = array();
    
    $asset = $child->getAsset( $service );
    
    if( $asset->hasPhantomNodes() )
    {
        $results[ $type ][] = $child->getPathPath();
    }
}
?>