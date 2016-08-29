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
    $page_id = "389b03188b7ffe83164c931405d3704f";
    
    // 1. use the $service object
    //$service->getAsset( a\Page::TYPE, $page_id )->dump();
    
    // 2. use the constructor
    //$page = new a\Page( $service, $service->createId( a\Page::TYPE, $page_id ) );
    //$page->dump();
    
    // 3. use the Child/Identifier class
    //$id = new p\Child( $service->createId( a\Page::TYPE, $page_id ) );
    //$id->getAsset( $service )->dump();
    
    // 4. use Asset::getAsset static method
    //a\Asset::getAsset( $service, a\Page::TYPE, $page_id )->dump();
    
    // 5. use $cascade->getAsset
    //$cascade->getAsset( a\Page::TYPE, $page_id )->dump();
    
    // 6. use $cascade->getX
    $cascade->getPage( $page_id )->dump();
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
    u\DebugUtility::out( "Hello" );
    
    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>