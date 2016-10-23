<?php

require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

/*
Phantom nodes of type A in pages:
The field name main-content-title does not exist.
Note that the data is still in the database when a field is removed.
*/

try
{
	$page = $cascade->getAsset(
	    a\Page::TYPE, "f195fa158b7ffe832dc7cebe6e43eecb" )->
	    dump();
	//u\DebugUtility::dump( $page );
	
	echo $service->getLastResponse();
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