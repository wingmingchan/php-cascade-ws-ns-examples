<?php 
/*
This program shows how to find all unpublishable pages.
*/
require_once('auth_chanw.php');

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
    
    $results = array();

    $cascade->getAsset( a\Folder::TYPE, '453d83318b7f08560139425c04f1636b' )->
        getAssetTree()->traverse(
            array( a\Page::TYPE => array( "assetTreeReportUnpublishableAsset" ) ), 
            NULL,
            $results );
            
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

function assetTreeReportUnpublishableAsset(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL
)
{
    $type = $child->getType();

    if( $type != a\Folder::TYPE &&
        $type != a\Page::TYPE &&
        $type != a\File::TYPE )
        return;
        
    if( !isset( $results ) )
        throw new \Exception( "No result array is passed in" );
        
    if( !isset( $results[ $type ] ) )
    {
        $results[ $type ] = array();
    }
    
    $asset = $child->getAsset( $service );
    
    if( !$asset->isPublishable() )
        $results[ $type ][] = $asset->getPath();
}
?>