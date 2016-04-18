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
	$page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
	
	// the targeted content type
	$ct = $cascade->getAsset( a\ContentType::TYPE, '1378b3e38b7f08ee1890c1e4df869132' );
	
	$page->setContentType( $ct );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>