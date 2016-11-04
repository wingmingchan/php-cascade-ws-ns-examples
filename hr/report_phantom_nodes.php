<?php
/*
This program is used to report phantom nodes of type A in pages.
*/

$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
	$site_name = "hr";
	$results = array();
    
    $cascade->getSite( $site_name )->getBaseFolderAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreeReportPhantomNodes" ) ),
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
    p\Child $child, $params=NULL, &$results=NULL )
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