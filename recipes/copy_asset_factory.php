<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
	$afc_path = "Upload";
	$af_name  = "Upload 400x200 Photo";
	$af_path  = $afc_path . "/" . $af_name;
	$seed_af  = $cascade->getAsset( a\AssetFactory::TYPE, "329db5f88b7f08ee384a2061dc545c49" );
	  
	$target_site_name = "foil";
	$site_af          = $cascade->getAssetFactory( $af_path, $target_site_name );
	
	if( !isset( $site_af ) )
	{
		$af_container = $cascade->getAsset( a\AssetFactoryContainer::TYPE, $afc_path, $target_site_name );
		$af = $seed_af->copy( $af_container, $af_name );
		$af->addGroup( $cascade->getAsset( a\Group::TYPE, "CWT-Designers" ) )->
		     addGroup( $cascade->getAsset( a\Group::TYPE, $target_site_name ) )->edit();
	}
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>