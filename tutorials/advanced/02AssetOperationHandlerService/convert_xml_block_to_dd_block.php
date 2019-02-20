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
    // get two blocks
    $xml_block = $cascade->getAsset(
        a\XmlBlock::TYPE, "b3d33caa8b7f08ee73363edd1b593d88" );
    $dd_block = $cascade->getAsset(
        a\DataBlock::TYPE, "31a4c6c78b7f08ee131ff8e306395c5a" );
        
    // read the property of the xml block so that we can keep the id, metadata, etc.
    $property = $xml_block->getProperty();
    // remove xml property
    unset( $property->xml );
    // read property from dd block and store it in property of xml block
    $property->structuredData = $dd_block->getProperty()->structuredData;
    $property->xhtml = null;
    // create new asset
    $asset = new \stdClass();
    $asset->xhtmlDataDefinitionBlock = $property;
    // submit
    $service->edit( $asset );
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