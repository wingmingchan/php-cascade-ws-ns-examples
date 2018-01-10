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
    $csc_name  = "Test CS Container";
    $csc = $cascade->getPageConfigurationSetContainer( $csc_name, $site_name );
    
    if( isset( $csc ) )
    {
        $cascade->deleteAsset( $csc );
    }
    
    $csc = $cascade->createPageConfigurationSetContainer(
        $cascade->getAsset( a\PageConfigurationSetContainer::TYPE, "/", $site_name ),
        $csc_name
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