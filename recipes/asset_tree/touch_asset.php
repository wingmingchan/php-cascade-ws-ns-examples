<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$cascade->getAsset( a\Folder::TYPE, "8b5193ee8b7f08ee26d2e6f290705401" )->getAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreeTouchAsset" ) )
        );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

function assetTreeTouchAsset( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\File::TYPE )
        return;
        
    $asset = $child->getAsset( $service );
    $asset->edit();
}
?>