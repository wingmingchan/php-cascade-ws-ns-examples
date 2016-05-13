<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    $site_name    = 'cascade-admin';
    $block_folder =
        $cascade->getAsset( a\Folder::TYPE, '_cascade/blocks/test', $site_name );
    $block_name   = 'folder-index';

    // create a folder index block
    $cib = $cascade->getIndexBlock( $block_folder->getPath() . "/" . $block_name );
    
    if( is_null( $cib ) )
    {
        $cascade->createIndexBlock(
            $block_folder,   // parent folder
            $block_name,
            c\T::FOLDER,     // type
            NULL,            // content type
            $cascade->getAsset( a\Folder::TYPE, '/', $site_name ) // folder to index
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