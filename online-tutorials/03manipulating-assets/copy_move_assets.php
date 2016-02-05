<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = "Page"; // control flag

try
{
    $site_name = 'cascade-admin';
    
    switch( $mode )
    {
        case "DataDefinitionBlock": // copy and move dd block
            $source_folder = 
                $cascade->getAsset( 
                    a\Folder::TYPE, '_cascade/blocks/data', $site_name );
            $target_folder = 
                $cascade->getAsset( 
                    a\Folder::TYPE, 'test-folder2/test-child-folder1', $site_name );
            $new_block =
                $cascade->getAsset( 
                        a\DataBlock::TYPE, '980c4a3b8b7f0856015997e491d1b113' )->
                    copy( $source_folder, 'test-open-x2' );
            $new_block->move( $target_folder );
            break;
            
        case "Page": // copy page
            $target_folder = 
                $cascade->getAsset( 
                    a\Folder::TYPE, 'test-folder2/test-child-folder1', $site_name );
            $page = $cascade->getAsset( a\Page::TYPE, 'faculty', 'cascade-admin' );
            $cascade->copyAsset( $page, $target_folder, 'copy' );
            
            //$page->copy( $target_folder, 'copy' );
            break;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>