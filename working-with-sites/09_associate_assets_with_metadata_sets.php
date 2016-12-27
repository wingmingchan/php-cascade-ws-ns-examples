<?php
$start_time = time();
/*
This program associates assets of different types
with different metadata sets.

Assumption:
For each type of assets, a separate metadata set is defined.
When a site is traverse, all assets of the same type will be
associated with the same metadata set.

This program does not use a metadata set for files. If needed,
the metadata set can be added.

We don't need to deal with pages, because the metadata set of pages
is associated with the content type.

The global function assetTreeAssociateWithMetadataSet is already defined.
But we need to associate different asset types with different metadata
sets.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
	$block_ms = $cascade->getAsset(
	    a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" );
	$folder_ms = $cascade->getAsset(
	    a\MetadataSet::TYPE, "5f4526098b7f08ee76b12c412063f8b8" );
	$symlink_ms = $cascade->getAsset(
	    a\MetadataSet::TYPE, "5f45261b8b7f08ee76b12c416580b064" );
	
	// set up the parameter array to pass in metadata sets   
	$params = array(
		a\DataBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
		a\FeedBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
		a\IndexBlock::TYPE => array( a\MetadataSet::TYPE => $block_ms ),
		a\TextBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
		a\XmlBlock::TYPE   => array( a\MetadataSet::TYPE => $block_ms ),
		a\Folder::TYPE     => array( a\MetadataSet::TYPE => $folder_ms ),
		a\Symlink::TYPE    => array( a\MetadataSet::TYPE => $symlink_ms )
	);
	    
	$site_name = "cascade-database";
	$site      = $cascade->getSite( $site_name );
	
	$site->getAssetTree()->traverse(
		array(
			a\DataBlock::TYPE  => array( "assetTreeAssociateWithMetadataSet" ),
			a\FeedBlock::TYPE  => array( "assetTreeAssociateWithMetadataSet" ),
			a\IndexBlock::TYPE => array( "assetTreeAssociateWithMetadataSet" ),
			a\TextBlock::TYPE  => array( "assetTreeAssociateWithMetadataSet" ),
			a\XmlBlock::TYPE   => array( "assetTreeAssociateWithMetadataSet" ),
			a\Folder::TYPE     => array( "assetTreeAssociateWithMetadataSet" ),
			a\Symlink::TYPE    => array( "assetTreeAssociateWithMetadataSet" )
		),
		$params
	);

    u\DebugUtility::outputDuration( $start_time );
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