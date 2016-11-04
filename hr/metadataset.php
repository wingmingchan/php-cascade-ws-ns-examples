<?php
/*
This program is used to folder, blocks, and symlinks with the proper metadata sets.
*/

$start_time = time();

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
    $site      = $cascade->getSite( "hrintra" );
    
    // retrieve the three metadata set from _common_assets
    $folder_ms = $cascade->getAsset(
        a\MetadataSet::TYPE, "5f4526098b7f08ee76b12c412063f8b8" );
    $block_ms  = $cascade->getAsset(
        a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" );
    $syml_ms   = $cascade->getAsset(
        a\MetadataSet::TYPE, "5f45261b8b7f08ee76b12c416580b064" );
    
    // set up the $params array and pass in the three metadata sets
    $params = array(
        a\Folder::TYPE => array( a\MetadataSet::TYPE => $folder_ms ),
        a\DataDefinitionBlock::TYPE => array( a\MetadataSet::TYPE => $block_ms ),
        a\IndexBlock::TYPE => array( a\MetadataSet::TYPE => $block_ms ),
        a\TextBlock::TYPE => array( a\MetadataSet::TYPE => $block_ms ),
        a\Symlink::TYPE => array( a\MetadataSet::TYPE => $syml_ms )
    );
    
    $at   = $site->getAssetTree();
    
    // the global function assetTreeAssociateWithMetadataSet is defined in
    // global_functions.php in the library
    $at->traverse(
        array(
            //a\Folder::TYPE => array( "assetTreeAssociateWithMetadataSet" ),
            a\DataDefinitionBlock::TYPE => array( "assetTreeAssociateWithMetadataSet" ),
            a\IndexBlock::TYPE => array( "assetTreeAssociateWithMetadataSet" ),
            a\TextBlock::TYPE => array( "assetTreeAssociateWithMetadataSet" ),
            a\Symlink::TYPE => array( "assetTreeAssociateWithMetadataSet" )
        ),
        $params
    );
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