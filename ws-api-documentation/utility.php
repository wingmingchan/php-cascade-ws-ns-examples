<?php
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-admin";
    
    $class_page_array = array(
        "cascade_ws_AOHS\AssetOperationHandlerService" =>
            "/web-services/api/AssetOperationHandlerService/api",
        "cascade_ws_utility\Cache" =>
            "/web-services/api/utility-classes/cache",
        "cascade_ws_utility\DebugUtility" =>
            "/web-services/api/utility-classes/debug-utility",
        "cascade_ws_utility\ReflectionUtility" =>
            "/web-services/api/utility-classes/reflection-utility",
        "cascade_ws_utility\StringUtility" =>
            "/web-services/api/utility-classes/string-utility",
        "cascade_ws_utility\XmlUtility" =>
            "/web-services/api/utility-classes/xml-utility",
    );
    
    foreach( $class_page_array as $class_name => $page_path )
    {
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );  
        $page->setText(
            "main-content-content",
            u\ReflectionUtility::getClassDocumentation( $class_name )
        )->edit()->publish();
        
        if( u\ReflectionUtility::getClassDocumentation( $class_name ) == "" )
        	echo "Warning!!!!", BR;
    }
    
    // publish the index page
    $page_id = $service->createId( a\Page::TYPE,  "/web-services/api/utility-classes/index", $site_name );
    $service->publish( $page_id );
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