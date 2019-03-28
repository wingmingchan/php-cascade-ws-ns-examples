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
    $ms = $admin->getAsset( a\MetadataSet::TYPE, "4135873a8b7f08ee0ed2ecdaca6a2fa2" );
    // output the metadata property
    u\DebugUtility::dump( $ms->getMetadata()->toStdClass() );
    // get the metadata set from the metadata
    $ms->getMetadata()->getMetadataSet()->dump();
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