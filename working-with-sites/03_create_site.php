<?php
/*
This program shows how to test if a site exists, and if it does not,
how to create it. Note that $cascade->getSite( $site_name ) throws an exception
if the site does not exist. When we use this to perform the test, we need to
catch the exception. The creation of the site appears in the catch block.
*/
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'web-service-tutorial';
    $url       = 'webapp.upstate.edu/web-service-tutorial';
    
    try
    {
        $cascade->getSite( $site_name );
        echo "The site $site_name already exists.";
    }
    catch( e\NoSuchSiteException $e )
    {
        $cascade->createSite(
            $site_name,
            $url,
            c\T::FIFTEEN // expiration: 15 days
        );
        echo "The site $site_name has been created.";
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