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
    $admin->getAsset( a\DataBlock::TYPE, "0b3aaa208b7f08ee5a4fada2258d6fb9" )->update(
        array(
            a\DublinAwareAsset::METADATA => array(
                // dynamic fields
                "macro" => "processDDBlock",
            ),
            // structured data nodes
            "wysiwyg-group;wysiwyg-content" => "<p>Je voudrais boire du vin.</p>",
        )
    )->dump();

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