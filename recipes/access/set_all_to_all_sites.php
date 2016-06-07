<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
	$sites = $cascade->getSites();
	
	foreach( $sites as $site )
	{
		$cascade->setAllLevel( a\Folder::TYPE, '/', $site->getPathSiteName(), 
			c\T::READ, true );
	}
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>
