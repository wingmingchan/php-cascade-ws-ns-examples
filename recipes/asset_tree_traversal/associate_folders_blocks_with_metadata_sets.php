<?php
$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');
// to prevent time-out
set_time_limit( 10000 );
// to prevent using up memory when traversing a large site
ini_set( 'memory_limit', '2048M' );

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_AOHS      as aohs;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $folder_id      = "8df13e888b7f085600ebf23eff9aca6d";
    $folder_ms      = $cascade->getAsset( a\MetadataSet::TYPE, "5f4526098b7f08ee76b12c412063f8b8" );
    $block_ms       = $cascade->getAsset( a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" );
    $function_array = array(
        a\Folder::TYPE     => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" ),
        a\IndexBlock::TYPE => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" ),
        a\TextBlock::TYPE  => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" ),
        a\DataBlock::TYPE  => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" ),
        a\FeedBlock::TYPE  => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" ),
        a\XmlBlock::TYPE   => array( "assetTreeAssociateFoldersBlocksWithMetadataSets" )
    );
    $param_array    = array(
        "folder-ms" => $folder_ms,
        "block-ms"  => $block_ms
    );

/*    
    // used to test the function
    $block_id = "5b8997138b7f0856002a5e111bc0d170";
    $child    = new p\Child( $service->createId( a\DataBlock::TYPE, $block_id ) );
    assetTreeAssociateFoldersBlocksWithMetadataSets( $service, $child, $param_array );
*/
    
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse( $function_array, $param_array );
    
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}

function assetTreeAssociateFoldersBlocksWithMetadataSets(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
    if( $type != a\Folder::TYPE &&
        $type != a\IndexBlock::TYPE &&
        $type != a\TextBlock::TYPE &&
        $type != a\DataBlock::TYPE &&
        $type != a\FeedBlock::TYPE &&
        $type != a\XmlBlock::TYPE )
        return;
        
    if( !is_array( $params ) || !isset( $params[ "folder-ms" ] ) || !isset( $params[ "block-ms" ] ) )
        throw new \Exception( "The metadata sets are not supplied" );
    
    $folder_ms = $params[ "folder-ms" ];
    $block_ms  = $params[ "block-ms" ];
    
    if( $type == a\Folder::TYPE )
        $child->getAsset( $service )->setMetadataSet( $folder_ms );
    else
        $child->getAsset( $service )->setMetadataSet( $block_ms );
}
?>