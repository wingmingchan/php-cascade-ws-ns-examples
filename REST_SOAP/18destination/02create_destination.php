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
    $site_name = "about-test";
    $dc_name   = "Test Destination Container";
    $d_name    = "upstate";
    
    $d = $cascade->getDestination( "$dc_name/$d_name", $site_name );
    
    if( isset( $d ) )
    {
        $cascade->deleteAsset( $d );
    }
    
    $ms = $cascade->createDestination(
        $cascade->getAsset( a\SiteDestinationContainer::TYPE, $dc_name, $site_name ),
        $d_name,
        $cascade->getAsset(
            a\FtpTransport::TYPE, 
            "Test Transport Container/Test FTP Transport",
            "_common" )
    )->dump();
    
    u\DebugUtility::dumpRESTCommands( $service );    
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