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
	$site_name = "test-about";
    
    try
    {
        $cascade->getSite( $site_name );
        u\DebugUtility::out( "The site already exist" );
    }
    catch( e\NoSuchSiteException $e )
    {
        $cascade->createSite( 
        	$site_name,
    		"http://www.upstate.edu",
    		c\T::FIFTEEN )->dump();
    }
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