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
    $admin->getAsset( a\Symlink::TYPE, "818095e28b7f08ee390f1615fd5e8400" )->update(
        array(
            a\DublinAwareAsset::METADATA => array(
                // wired fields
                a\DublinAwareAsset::SUMMARY => "Some external link",
                // dynamic fields
                "exclude-from-menu"         => "yes"
            ),
            // symlink data
            a\Asset::LINK_URL    => "https://www.msnbc.com/",
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