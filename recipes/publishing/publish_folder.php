<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
	$cascade->getAsset( 
        	a\Folder::TYPE, 'db2739f48b7f0856002a5e1142f03f6b' )->
    	getAssetTree()->traverse(
        	array( a\Page::TYPE => array( c\F::PUBLISH ) )
    );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>