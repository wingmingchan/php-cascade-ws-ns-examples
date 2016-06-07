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
    $at = $cascade->getAsset( a\Folder::TYPE, '4a4fc2d38b7f085600ebf23e49dfc2fd' )->
        getAssetTree();
    echo $at->toListString();
      
    $xml_string = str_replace( "<", "&lt;", $at->toXml() );  
    echo S_PRE, $xml_string, E_PRE;
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>