<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

/*
Phantom nodes of type A in blocks:
The data cannot be read, yet it is still stored in the database.
Use edit to remove the unwanted data.
*/
try
{
	$block = $cascade->getAsset(
	    a\DataBlock::TYPE, "ec29d12c8b7ffe832dc7cebea81e066f" )->edit();
	u\DebugUtility::dump( $block->getIdentifiers() );
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