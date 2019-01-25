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
    $admin->getAsset( a\AssetFactory::TYPE, "d5614f418b7f08ee363559330f0af607" )->update(
        array(
            // asset factory data
            "description"             => "Test Asset Factory",
            "overwrite"               => true,
            "allowSubfolderPlacement" => true
        )
    )
    ->dump();

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