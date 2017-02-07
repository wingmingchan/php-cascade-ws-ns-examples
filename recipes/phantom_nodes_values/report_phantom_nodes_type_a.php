<?php
/*
This program can be used to report phantom nodes of type A.
It program can take a very long time to run.
*/
$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

// site to be traverse
$site_name = "cascade-admin"; // 636 seconds
$folder_id = "bafa363d8b7f08ee2dbad4e8a9bc49dd";

try
{
    u\DebugUtility::setTimeSpaceLimits();

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
    
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er ) 
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}

function assetTreeReportPhantomNodes( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    if( !isset( $results ) || !is_array( $results ) )
        throw new \Exception( "The results array is required" );

    $type = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataBlock::TYPE )
        return;
    
    try
    {
        $asset = $child->getAsset( $service );
    }
    catch( e\NoSuchFieldException $e )
    {
        if( !isset( $results[ $type ] ) )
            $results[ $type ] = array();
        
        $results[ $type ][] = $child->getPathPath();
    }
}
?>