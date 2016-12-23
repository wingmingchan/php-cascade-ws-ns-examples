<?php
/*
Listing sites can be seen as the starting point of site management using web services.
From a site object, we can get to almost anything existing in that site.
Note that while $cascade->getSite( $site_name ) returns a Site object,
$cascade->getSites() returns an array of Child object. With a Child object,
use $child->getAsset( $service ) to get the site object.

From a site, we can get the base folder and any root container containing components like
data definitions and metadata sets.
*/
$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // set parameters for timing: about 20 seconds
    u\DebugUtility::setTimeSpaceLimits();
    
    // $sites store an array of Child objects
    $sites = $cascade->getSites();
    
    // output some site information
    foreach( $sites as $site )
    {
        // access the site name through the Child object
    	// output site name
        echo "Site name: ", $site->getPathPath(), BR;
        
        // get the Site object through the Child object
        $site_obj = $site->getAsset( $service );
        
        // output the URL
        echo "Site URL: ", $site_obj->getUrl(), BR;
        // output recycle bin expiration
        echo "Recyle bin expiration: ", $site_obj->getRecycleBinExpiration(), BR;
        
        echo HR;
    }
    
    // output the duration taken
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>