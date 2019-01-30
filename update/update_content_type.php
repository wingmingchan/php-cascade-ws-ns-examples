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
    // Before we can delete the data definition, we must remove all inline editable
    // fields associated with the original data definition first.
    // Note that there is a bug in this area in Cascade.
    // This line will remove ALL fields:
    //$admin->getAsset( a\ContentType::TYPE, "9f2c6baa8b7f08ee29c9ee3decfc2a0d" )->
    //    removeInlineEditableField( "Page;DEFAULT;NULL;data-definition;bottom-group" )->edit();
    
    // Now remove the data definition
    $admin->getAsset( a\ContentType::TYPE, "9f2c6baa8b7f08ee29c9ee3decfc2a0d" )->update(
        array(
            // content type data and switch the metadata set
            "dataDefinition" => NULL,
            "metadataSet"    => $admin->getAsset( a\MetadataSet::TYPE, "1cd91a998b7f08ee7df4e217a65462b1" )
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