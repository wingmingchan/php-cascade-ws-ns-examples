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
    $dd = $admin->getAsset( a\DataDefinition::TYPE, "9b7e13d88b7f08ee3b01b0ac76ae5b62" ); 
    // get the structured data
    $sd = $dd->getStructuredDataObject();
    u\DebugUtility::dump( $sd->toStdClass() );
    // get the data definition out of the structured data
    $sd->getDataDefinition()->dump();
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