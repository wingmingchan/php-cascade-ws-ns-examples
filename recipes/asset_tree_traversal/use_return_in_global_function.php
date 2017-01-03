<?php 
/*
This program shows how to use a return statement in a global function to skip
processing assets.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $cascade->getAsset(
            a\Folder::TYPE, "ffe39a278b7f08ee3e513744c5d70ead" )->getAssetTree()->
        traverse(
            // invoke the global function for four types of assets
            // could be by mistake
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
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
}

function assetTreeSimpleFunction(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL
)
{
    $type = $child->getType();
    
    // only process two types of assets
    // skip all other types if the function is not designed to process them
    if( $type != a\Page::TYPE && $type != a\Folder::TYPE )
        return;
        
    echo "Process ", $type, BR;
}
?>