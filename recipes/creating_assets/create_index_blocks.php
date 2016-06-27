<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name     = 'web-service-tutorial';
    $block_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $ct            = $cascade->getAsset( 
        a\ContentType::TYPE, 
        'Test Content Type Container/Normal XHTML', $site_name );

    $block_name = 'normal-xhtml-index';
    $block      = $cascade->getIndexBlock( 'blocks/' . $block_name, $site_name );
    
    if( is_null( $block ) )
    {
        // create a content type index block
        $cib = $cascade->createContentTypeIndexBlock(
            $block_folder,
            $block_name,
            $ct
        );
    }

    $block_name = 'folder-index';
    $block      = $cascade->getIndexBlock( 'blocks/' . $block_name, $site_name );
    
    if( is_null( $block ) )
    {
        // create a folder index block
        $cib = 
            $cascade->createFolderIndexBlock(
                $block_folder,
                $block_name,
                $cascade->getAsset( a\Folder::TYPE, '/', $site_name )
            )->
            setDepthOfIndex( 5 )->
            setIndexFiles( true )->
            setIndexPages( true )->
            edit();
    }        
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>