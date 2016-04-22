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
    assetTreeSimpleFunction( 
        $service, 
        new p\Child( 
            $service->createId( a\Page::TYPE, "aefe9f168b7f08ee02067bea0e5de36b" )
        ) 
    );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

function assetTreeSimpleFunction(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL
)
{
    $type = $child->getType();
    echo $type, BR;
    
    $asset = $child->getAsset( $service );
    $asset->dump( true );
}
?>