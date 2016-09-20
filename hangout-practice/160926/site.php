<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $sites = $cascade->getSites();
    //u\DebugUtility::dump( $sites );
    
    foreach( $sites as $site )
    {
        echo $site->getPathPath(), BR;
    }
    
    $site = $cascade->getSite( "22q" );
    
    $site->getBaseFolder()->dump();
    $site->getRootAssetFactoryContainer()->dump();
    $site->getRootMetadataSetContainer()->dump();
    
    u\ReflectionUtility::showMethodSignatures(
        "cascade_ws_asset\Site" );
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