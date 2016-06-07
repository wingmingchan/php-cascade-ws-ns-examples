<?php
/*
This program is used to convert a site, from RWD2 to RWD2.1, using a one-region template.
The program can be used to convert a few pages at a time, or a folder at a time.
*/

$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

// to prevent time-out
set_time_limit( 10000 );
// to prevent using up memory when traversing a large site
ini_set( 'memory_limit', '2048M' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page_ids = array(
        "2eb0319a8b7f0856002a5e11a1cd0425",
/*
        "0cf8292c8b7f085600355d3a745ad6ce",
        "197191f08b7f085600d384a43e273019",
        "585d60408b7f0856004762756bab59df",
        "918e2ce28b7f08ee1ccdcc660cbacce8",
        "3abb16628b7f08560135b47ca65b7c16",
        "9cf480228b7f08560175249c2eb949fa",
        "6dda3db48b7f08ee0182b0c87d1bcac0",
        "0a6b50b48b7f08560111a20cfb7ec4de",
        "0826c3db8b7f085600a73f4bd53e8a9e",
*/
    );

    $folder_id                = "9d6b193f8b7f08ee42e2f3672f4d5488"; 

    $site_storage_block       = $cascade->getAsset( a\DataBlock::TYPE, "ea51caec8b7f08ee1c99f4958efb7698" );
    $global_link_script_block = $cascade->getAsset( a\TextBlock::TYPE, "13618dd38b7f08ee1890c1e411561de0" );
    $page_title_block         = $cascade->getAsset( a\TextBlock::TYPE, "1368bba28b7f08ee1890c1e497d5ae69" );
    $search_form_block        = $cascade->getAsset( a\TextBlock::TYPE, "136974b98b7f08ee1890c1e42b059915" );
    $one_region_ct            = $cascade->getAsset( a\ContentType::TYPE, "1378b3e38b7f08ee1890c1e4df869132" );

    $params = array(
        'site-storage'       => $site_storage_block,
        'global-link-script' => $global_link_script_block,
        'page-title'         => $page_title_block,
        'search-form'        => $search_form_block,
        'content-type'       => $one_region_ct
    );
    
    //$mode = "page";
    $mode = "folder";
    
    switch( $mode )
    {
        case "page":
            foreach( $page_ids as $page_id )
            {
                $child = new p\Child( $service->createId( a\Page::TYPE, $page_id ), $service );
                assetTreeConvertToOneRegionTemplate( $service, $child, $params );
            }
            break;

        case "folder":
            $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
                traverse(
                    array( a\Page::TYPE => array( "assetTreeConvertToOneRegionTemplate" ) ),
                    $params
                );
            break;
    }

    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}

function assetTreeConvertToOneRegionTemplate( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, 
    $params=NULL, &$results=NULL )
{
    if( !isset( $params[ 'site-storage' ] ) ||
        !isset( $params[ 'global-link-script' ] ) ||
        !isset( $params[ 'page-title' ] ) ||
        !isset( $params[ 'search-form' ] ) ||
        !isset( $params[ 'content-type' ] )
    )
        throw new \Exception( "Some of the parameters are missing." );

    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    // skip entire folder
    if( strpos( $child->getPathPath(), "_extra/" ) !== false )
        return;
        
    if( strpos( $child->getPathPath(), "_cascade/" ) !== false )
        return;
        
        
    $site_storage_block       = $params[ 'site-storage' ];
    $global_link_script_block = $params[ 'global-link-script' ];
    $page_title_block         = $params[ 'page-title' ];
    $search_form_block        = $params[ 'search-form' ];
    $one_region_ct            = $params[ 'content-type' ];
    
    $page = $service->getAsset( $child->getType(), $child->getId() );
    
    try
    {
        $page->setContentType( $one_region_ct );
        $cur_sd  = $page->getStructuredData();
        $new_sd  = $cur_sd->mapData();
        $page->setStructuredData( $new_sd );
        $page->
            setBlock( "site-config-group;site-storage", $site_storage_block )->
            setBlock( "site-config-group;global-link-script", $global_link_script_block )->
            setBlock( "site-config-group;page-title", $page_title_block )->
            setBlock( "site-config-group;search-form", $search_form_block )->edit();
    }
    catch( \Exception $e )
    {
        echo $page->getId(), BR;
        throw $e;
    }
}
?>