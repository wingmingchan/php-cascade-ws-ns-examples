<?php
require_once( 'auth_tutorial7.php' );
require_once( 'cascade_ws_extend/ws_lib.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;
use cascade_ws_extend    as ex;

$start_time = time();

try
{
	$ur = new ex\UpstateReport( $cascade );
	$ur->setRootFolder(
		$cascade->getAsset( a\Folder::TYPE, "345f43438b7ffe83164c9314b1de4131" ) );
		
	u\DebugUtility::dump( $ur->reportNumberOfTemplates() );
	//u\DebugUtility::dump( $ur->reportTemplateFormatPaths() );
	
	
	u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
	echo S_PRE . $er . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
?>