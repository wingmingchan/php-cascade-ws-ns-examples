<?php 
/*
This program shows how to use a switch statement in a global function to
control the logic of processing assets of different types.
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
    
    switch( $type )
    {
        case a\Page::TYPE:
            echo "Process page", BR;
            break;
            
        case a\Folder::TYPE:
            echo "Process folder", BR;
            break;
            
        case a\File::TYPE:
            echo "Process file", BR;
            break;
            
        default:
        	echo "Encountered a $type. ";
            echo "Do Nothing", BR;
            break;
    }
}
?>