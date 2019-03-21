<?php
require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $ms  = $admin->getAsset( a\MetadataSet::TYPE, "4ccdf3b6ac1e001b4d6de175f9541fe9" );
    $dfd = $ms->getDynamicMetadataFieldDefinition( "gender" );
    u\DebugUtility::dump( $dfd->toStdClass() );
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