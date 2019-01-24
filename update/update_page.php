<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    $page = $admin->getAsset( a\Page::TYPE, "e0eda56d8b7f08ee6d3c97debe88d809" );
    //u\DebugUtility::dump( $page->getIdentifiers() );
    
    $page->update(
        array(
            a\DublinAwareAsset::METADATA => array(
                // wired fields
                a\DublinAwareAsset::AUTHOR       => "Wing",
                a\DublinAwareAsset::DISPLAY_NAME => "Struts 2 in Action",
                a\DublinAwareAsset::KEYWORDS     => "",
                a\DublinAwareAsset::SUMMARY      => "Struts 2 in Action",
                // dynamic fields
                "exclude-from-menu"              => NULL,
                "tree-picker"                    => array( "inherited" )
            ),
            // page settings
            a\DublinAwareAsset::SHOULD_BE_PUBLISHED     => false,
            a\DublinAwareAsset::SHOULD_BE_INDEXED       => false,
            a\DublinAwareAsset::MAINTAIN_ABSOLUTE_LINKS => true,
            // structured data nodes
            "main-group;h1"                   => "Struts 2 in Action",
            "main-group;mul-pre-h1-chooser;0" => NULL // remove block
        )
    )->dump();
/*/
    $page->update(
        array(
            "main-group;h1"                      => "New H1",
            "main-group;mul-pre-h1-chooser;0"    => $admin->getAsset(
                           a\DataBlock::TYPE, "4b7064cd8b7f08ee72410d245689237a" )
        )
    )->dump();
/*/

    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";

    //cho u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Page" );
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