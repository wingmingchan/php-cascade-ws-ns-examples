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
    $site_name        = 'web-service-tutorial';
	$desktop_template = 
		$cascade->getAsset(
			a\Template::TYPE, 'templates/three-columns', $site_name );
	$xml_template     = 
		$cascade->getAsset( a\Template::TYPE, 'templates/xml', $site_name );

	// create a text block to be attached to a region at the config level
	$block_folder  =
		$cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
	$code = "<div id='top-graphics'>Top Graphics</div>";

	$block_name = 'top-graphics';
	$block      = $cascade->getTextBlock( 'blocks/' . $block_name, $site_name );
	
	if( is_null( $block ) )
	{
		$block = $cascade->createTextBlock(
			$block_folder,
			$block_name,
			$code );
	}
	
	$csc_name = 'Test Configuration Set Container';
	$csc      = $cascade->getPageConfigurationSetContainer( $csc_name, $site_name );

	if( is_null( $csc ) )
	{
		// create configuration set container
		$csc = $cascade->createPageConfigurationSetContainer(
			$cascade->getAsset( 
				a\PageConfigurationSetContainer::TYPE, '/', $site_name ),
			'Test Configuration Set Container'
		);
	}
	
	$pcs_name = 'Three Columns';
	$pcs      = $cascade->getPageConfigurationSet( $csc_name . '/' . $pcs_name, $site_name );

	if( is_null( $pcs ) )
	{
		// create configuration set with default configuration
		$pcs = $cascade->createPageConfigurationSet(
			$csc,              // parent container
			$pcs_name,         // configuration set name
			'Desktop',         // default configuration name
			$desktop_template, // template
			'.php',            // file extension
			c\T::HTML          // serialization type
		)->
		// attach a block to a region at config level
		setConfigurationPageRegionBlock( 
			'Desktop', 'TOP GRAPHICS', $block )->
		edit();
		// add xml configuration
		$pcs->addPageConfiguration( 'XML', $xml_template, '.xml', c\T::XML );        
	}
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>