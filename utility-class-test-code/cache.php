<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$cache                = u\Cache::getInstance( $service );
	$template_id_stdClass = $service->createId( a\Template::TYPE, "78c760648b7f0856004564242ce4d1d1" );
	$template_identifier  = new p\Child( $template_id_stdClass );

	// test cache time
	$start_time = time();
	
	for( $i = 0; $i < 50; $i++ )
	{
		$template = $cache->retrieveAsset( $template_identifier );
	}
	
	$end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
    
    u\DebugUtility::dump( $cache );
    $cache->clearCache();
    u\DebugUtility::dump( $cache );
    
    // test direct retrieval time
	$start_time = time();
	
	for( $i = 0; $i < 50; $i++ )
	{
		$template = $template_identifier->getAsset( $service );
	}
	
	$end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
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