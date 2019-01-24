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
    $admin->getAsset( a\IndexBlock::TYPE, "cf8f51928b7f08ee1ebd6240159f1101" )->update(
        array(
            a\DublinAwareAsset::METADATA => array(
                // wired fields
                a\DublinAwareAsset::AUTHOR => "Wing",
                // dynamic fields
                "macro" => "processIndexBlock",
            ),
            // block data
            a\DublinAwareAsset::MAX_RENDERED_ASSETS => 50,
            a\DublinAwareAsset::DEPTH_OF_INDEX      => 5,
            a\DublinAwareAsset::INDEX_LINKS         => true
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