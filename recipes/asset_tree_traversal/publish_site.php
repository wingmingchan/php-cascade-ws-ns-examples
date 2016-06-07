<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // the folder could be the base folder or any folder within
    $folder_id = '35dbee958b7f0856005cba16d6b3fbcc';
    $cascade->getAsset( 
            a\Folder::TYPE, $folder_id )->
        getAssetTree()->traverse(
            array( a\Page::TYPE => array( c\F::PUBLISH ) )
        );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>