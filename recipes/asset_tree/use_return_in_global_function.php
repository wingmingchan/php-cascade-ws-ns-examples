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
    $cascade->getAsset( a\Folder::TYPE, "ffe39a278b7f08ee3e513744c5d70ead" )->getAssetTree()->
        traverse(
            array( a\Page::TYPE =>         array( "assetTreeSimpleFunction" ),
                   a\Folder::TYPE =>       array( "assetTreeSimpleFunction" ),
                   a\ScriptFormat::TYPE => array( "assetTreeSimpleFunction" ),
                   a\DataBlock::TYPE =>    array( "assetTreeSimpleFunction" )
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
    
    if( $type != a\Page::TYPE && $type != a\Folder::TYPE )
        return;
        
    echo "Process ", $type, BR;
}
?>