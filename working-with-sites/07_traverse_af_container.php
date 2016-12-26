<?php
$start_time = time();
/*
This program shows how to traverse a container,
and possibly modify its contents.
It can be used as a frame to house useful code.
*/
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
    $site_name = "cascade-database";
    $site = $cascade->getSite( $site_name );
    
    $site->getRootAssetFactoryContainerAssetTree()->
        traverse(
            array(
                // associate asset factories with method
                a\AssetFactory::TYPE => 
                    array( "assetTreeTouchAssetFactory" ) )
        );
        
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function assetTreeTouchAssetFactory(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    // get the type
    $type = $child->getType();
    
    // skip if not an asset factory
    if( $type != a\AssetFactory::TYPE )
        return;
        
    // get the asset factory
    $at = $child->getAsset( $service );
    
    // do something with the asset factory
    
    // commit the changes
    $at->edit();
}
?>