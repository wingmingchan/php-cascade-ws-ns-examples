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
	$folder = $cascade->getAsset( a\Folder::TYPE, "1f22a4ec8b7ffe834c5fe91e57655349" );
	$ms = $cascade->getAsset( a\MetadataSet::TYPE, "358be6af8b7ffe83164c9314f9a3c1a6" );
	
	$at_util = new ex\AssetTreeUtility( $cascade );
	$at_util->associateBlocksWithMetadataSet( $folder, $ms );
	
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