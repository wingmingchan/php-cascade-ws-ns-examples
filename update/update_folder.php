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
    $admin->getAsset( a\Folder::TYPE, "e0eda35a8b7f08ee6d3c97dea0f6da4e" )->update(
        array(
            a\DublinAwareAsset::METADATA => array(
                // wired fields
                a\DublinAwareAsset::AUTHOR       => "Wing",
                a\DublinAwareAsset::DISPLAY_NAME => "Struts 2 in Action",
                a\DublinAwareAsset::SUMMARY      => "Struts 2 in Action",
                // dynamic fields
                "exclude-from-menu"              => ""
            ),
            // folder settings
            a\Asset::SHOULD_BE_PUBLISHED         => true,
            a\Asset::SHOULD_BE_INDEXED           => true,
            a\Asset::INCLUDE_IN_STALE_CONTENT    => true
        )
    )->dump();

    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
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