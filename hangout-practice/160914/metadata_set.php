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
    $page = $cascade->getAsset( a\Page::TYPE, "1f2376798b7ffe834c5fe91ead588ce1" );
    $m    = $page->getMetadata();
    //u\DebugUtility::dump( 
        //$m->getMetadataSet()->
            //getDynamicMetadataFieldPossibleValueStrings( "exclude-from-menu" ) );
    
    if( $m->isPossibleValue( "exclude-from-menu", "Yes" ) )
    {
        $m->setDynamicFieldValue( "exclude-from-menu", "Yes" );
        $page->edit();
    }
    
    $m->setDynamicFieldValue( "exclude-from-menu", NULL )->getHostAsset()->edit();
    
    //u\DebugUtility::dump(  );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );

    u\DebugUtility::dump( $page );

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>