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
    $page     = $cascade->getAsset( a\Page::TYPE, "1b399c028b7ffe83164c9314f7323a98" );

    $data     = $page->getProperty()->structuredData;
    $metadata = $page->getProperty()->metadata;
    $region   = $page->getProperty()->pageConfigurations->pageConfiguration[ 0 ]->
                pageRegions->pageRegion;
    
    u\DebugUtility::dump( $data );
    u\DebugUtility::dump( $metadata );
    u\DebugUtility::dump( $region );
    
    echo $data->structuredDataNodes->structuredDataNode[ 0 ]->identifier, BR;
    echo $metadata->dynamicFields->dynamicField[ 1 ]->name, BR;
    echo $region->name, BR;
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