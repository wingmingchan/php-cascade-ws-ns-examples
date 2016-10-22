<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$block = $cascade->getAsset( a\DataBlock::TYPE, "1f21cf0c8b7ffe834c5fe91e6dde13c2" );
	
	echo $block->getProperty()->structuredData->structuredDataNodes->
	    structuredDataNode[ 6 ]->text; // second 2
	
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