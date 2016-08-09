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
	$cascade->getSite( "foil" )->publish(
		$cascade->getAsset( a\Destination::TYPE, "f0a0bdf58b7f085600d330dabd5ad9d8" )
	);
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>