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
    $site = $cascade->getSite( "about" );
    
    try
    {
        $new_site = $cascade->getSite( "about-copy" );
        $cascade->deleteAsset( $new_site );
    }
    catch( e\NoSuchSiteException $e )
    {
        // do nothing
    }
    
    $new_site = $cascade->copySite( $site, "about-copy" );
    $new_site->dump();
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