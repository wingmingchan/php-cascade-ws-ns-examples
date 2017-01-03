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
    $site_name   = 'web-service-tutorial';
    $base_folder = $cascade->getAsset( a\Folder::TYPE, '/', $site_name );
    $page_name   = 'index';
    $page        = $cascade->getPage( $page_name, $site_name );
    
    if( is_null( $page ) )
    {
        $ct = $cascade->getAsset( 
            a\ContentType::TYPE, 
            'Test Content Type Container/Normal XHTML', $site_name );

        // create an xhtml page
        $code = "<p>Some content for index.</p>";
        $cascade->createXhtmlPage(
            $base_folder,
            $page_name,
            $code,
            $ct
        )->
        setRegionBlock(
            'Desktop',       // config name
            'SEARCH PRINT',  // region name
            // the block
            $cascade->getAsset( 
                a\DataBlock::TYPE, 'blocks/simple-text-block', $site_name )
        )->edit();
    }
    
    $page_name = 'test';
    $page      = $cascade->getPage( $page_name, $site_name );

    if( is_null( $page ) )
    {
        $ct = $cascade->getAsset( 
            a\ContentType::TYPE, 
            'Test Content Type Container/Three Columns', $site_name );
            
        $cascade->createDataDefinitionPage(
            $base_folder,
            $page_name,
            $ct
        )->
        // attach block
        setRegionBlock(
            'Desktop',  // config name
            'STORAGE',  // region name
            // the block
            $cascade->getAsset( 
                a\DataBlock::TYPE, 'blocks/xhtml-block', $site_name )
        )->edit();
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