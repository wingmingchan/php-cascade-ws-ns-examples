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
	$site_name     = "ws-tutorial-wing";
	$base_folder   = $cascade->getSite( $site_name )->
		getBaseFolder();
	$blocks_folder = $cascade->getAsset( 
		a\Folder::TYPE, "blocks", $site_name );
		
	echo "isParentOf: ", u\StringUtility::boolToString( 	
		$base_folder->isParentOf( $blocks_folder ) ), BR;
		
	echo "isChildOf: ", u\StringUtility::boolToString( 	
		$blocks_folder->isChildOf( $base_folder ) ), BR;
		
	echo "contains: ", u\StringUtility::boolToString( 	
		$base_folder->contains( $blocks_folder ) ), BR;

	echo "isContainedBy: ", u\StringUtility::boolToString( 	
		$blocks_folder->isInContainer( $base_folder ) ), BR;
		
	u\DebugUtility::dump( $blocks_folder->getChildren() );
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