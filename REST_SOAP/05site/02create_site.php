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
    
    try
    {
        $site = $cascade->getSite( $site_name ); // inheritDataChecksEnabled
        $cascade->deleteAsset( $site );
    }
    catch( e\NoSuchSiteException $e )
    {
        // do nothing
    }
    $cascade->createSite( 
        $site_name,
        "http://www.upstate.edu",
        c\T::FIFTEEN )->dump();
/*/
/*/
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