<?php
require_once('auth_REST_SOAP.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	// page here is a type
	$id = $service->createId(
	    "page", "275f515a8b7f08ee5668fbfd3fe3e766" );
	// page here is a property
	$page = $service->retrieve( $id, "page" );
	// soap
	if( $service->isSoap() )
		$page->structuredData->
			structuredDataNodes->structuredDataNode[ 1 ]->
			structuredDataNodes->structuredDataNode[ 2 ]->text =
			"New H1";
    // rest
    else
		$page->structuredData->
			structuredDataNodes[ 1 ]->
			structuredDataNodes[ 2 ]->text = "New H1";
    
    $pageObj = new \stdClass();
    $pageObj->page = $page;
    u\DebugUtility::dump( $pageObj );
	$service->edit( $pageObj );
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