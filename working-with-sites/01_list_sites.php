<?php
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
        echo $site->getPathPath(), BR;
        
        // get the Site object through the Child object
        $site_obj = $site->getAsset( $service );
        
        // output the URL
        echo $site_obj->getUrl(), BR;
        // output recycle bin expiration
        echo $site_obj->getRecycleBinExpiration(), BR;
        
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