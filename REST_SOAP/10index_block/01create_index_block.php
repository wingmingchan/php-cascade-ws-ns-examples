<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name          = "about-test";
    $parent_folder_path = "_cascade/blocks/index";
    $index_block_name   = "calling-page";
    
    $block = $cascade->getIndexBlock(
        "$parent_folder_path/$index_block_name", $site_name );
    
    if( isset( $block ) )
        $cascade->deleteAsset( $block );
        
    $block = $cascade->createIndexBlock(
        $cascade->getAsset( a\Folder::TYPE, $parent_folder_path, $site_name ),
        $index_block_name,
        a\Folder::TYPE
    );

    $block->setRenderingBehavior( c\T::HIERARCHYWITHSIBLINGS )->
        setAppendCallingPageData( true )->
        setIndexRegularContent( true )->
        setIndexSystemMetadata( true )->
        setIndexUserMetadata( true )->
        setIndexPages( true )->
        setIndexLinks( true )->
        setPageXML( c\T::RENDERCURRENTPAGEONLY )->
        setSortMethod( c\T::FOLDERORDER )->edit();

    u\DebugUtility::dumpRESTCommands( $service );
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