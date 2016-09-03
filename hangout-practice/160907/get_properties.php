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
    $page = $cascade->getAsset( a\Page::TYPE, "e233f1458b7ffe8364375ac786dcd9c8" );
    
    // get the metadata object
    $m = $page->getMetadata();
    u\DebugUtility::dump( $m->toStdClass() );
    
    $sd = $page->getStructuredData();
    u\DebugUtility::dump( $sd->toStdClass() );
    
    $pr = $page->getPageRegion( "RWD", "DEFAULT" );
    u\DebugUtility::dump( $pr->toStdClass() );
    
    //$page->dump();
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