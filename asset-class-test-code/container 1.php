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
    $folder = $cascade->getAsset( a\Folder::TYPE, "e637b2d98b7f08ee71e0db967edcd450" );
    $folder->deleteAllChildren();
    
    $folder = $cascade->getAsset( a\Folder::TYPE, "e636ef478b7f08ee71e0db96b386c7f8" );
    u\DebugUtility::dump( $folder->getChildren() );
    u\DebugUtility::dump( $folder->getContainerChildrenIds() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>