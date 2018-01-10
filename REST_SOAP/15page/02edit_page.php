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
    $site_name = "about-test";
    $page_name = "index";
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    
    $page->setText( "main-group;wysiwyg", "<p>Some page content</p>" )->
        createNInstancesForMultipleField( 2, "main-group;mul-post-wysiwyg-chooser;0" )->
        setBlock( "main-group;mul-post-wysiwyg-chooser;0",
            $cascade->getAsset(
                a\DataDefinitionBlock::TYPE, 
                "_cascade/blocks/data/wysiwyg1", $site_name ) )->
        setBlock( "main-group;mul-post-wysiwyg-chooser;1",
            $cascade->getAsset(
                a\DataDefinitionBlock::TYPE, 
                "_cascade/blocks/data/wysiwyg2", $site_name ) )->
        setText( "main-group;h1", "Test Page" )->
        swapData(
            "main-group;mul-post-wysiwyg-chooser;0",
            "main-group;mul-post-wysiwyg-chooser;1" )->
        edit();
        
    u\DebugUtility::dump( $page->getIdentifiers() );
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