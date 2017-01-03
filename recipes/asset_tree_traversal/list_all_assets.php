<?php 
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $at = $cascade->getAsset( a\Folder::TYPE, 'c0a77f3d8b7f0856002a5e11f1d4c763' )->
        getAssetTree();
    echo $at->toListString();
      
    echo S_PRE, u\XmlUtility::replaceBrackets( $at->toXml() ), E_PRE;  
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
}
?>