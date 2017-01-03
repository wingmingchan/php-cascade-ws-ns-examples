<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name  = 'web-service-tutorial';
    $block_name = 'xhtml-block';
    $block      = $cascade->getDataBlock( 'blocks/' . $block_name, $site_name );
    
    if( is_null( $block ) )
    {
        // create an xhtml block to be attached to a region at the page level
        $block_folder =
            $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
        $code = "<p>Some content.</p>";

        $cascade->createXhtmlBlock(
            $block_folder,
            $block_name,
            $code );
    }
    
    $block_name = 'simple-text-block';
    $block      = $cascade->getDataBlock( 'blocks/' . $block_name, $site_name );
    
    if( is_null( $block ) )
    {
        // create a data definition block 
        // to be attached to a region at the page level
        $data_definition =
            $cascade->getAsset( 
                a\DataDefinition::TYPE, 
                'Test Data Definition Container/Simple Text', $site_name );
        $block_folder =
            $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
        $cascade->createDataDefinitionBlock(
            $block_folder,
            $block_name,
            $data_definition )->
        setText( 'text', 'Some content for the data block.' )->
        edit();
    }        
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