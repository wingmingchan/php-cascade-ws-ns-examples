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
    $site_name   = "about-test";
    $folder_path = "_cascade/blocks/data";
    $block1_name = "wysiwyg1";
    $block2_name = "wysiwyg2";
    $dd_path     = "Test DD Container/WYSIWYG";
    
    $block1 = $cascade->getDataDefinitionBlock( "$folder_path/$block1_name", $site_name );
    $block2 = $cascade->getDataDefinitionBlock( "$folder_path/$block2_name", $site_name );

    if( isset( $block1 ) )
    {
        $cascade->deleteAsset( $block1 );
    }
    
    if( isset( $block2 ) )
    {
        $cascade->deleteAsset( $block2 );
    }
    
    $block1 = $cascade->createDataDefinitionBlock(
        $cascade->getAsset( a\Folder::TYPE, $folder_path, $site_name ),
        $block1_name,
        $cascade->getAsset( a\DataDefinition::TYPE, $dd_path, $site_name ) );
        
    $block2 = $cascade->createDataDefinitionBlock(
        $cascade->getAsset( a\Folder::TYPE, $folder_path, $site_name ),
        $block2_name,
        $cascade->getAsset( a\DataDefinition::TYPE, $dd_path, $site_name ) );

    $block1->setText(
        "wysiwyg-group;wysiwyg-content", "<p>Some content for block 1</p>" )->edit();
        
    $block2->setText(
        "wysiwyg-group;wysiwyg-content", "<p>Some content for block 2</p>" )->edit();
        
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