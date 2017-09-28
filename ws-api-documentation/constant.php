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
    $site_name = "web-services";
    
    $class_page_array = array(
        "cascade_ws_constants\F" =>
            "/api/constant-classes/f",
        "cascade_ws_constants\L" =>
            "/api/constant-classes/l",
        "cascade_ws_constants\M" =>
            "/api/constant-classes/m",
        "cascade_ws_constants\P" =>
            "/api/constant-classes/p",
        "cascade_ws_constants\S" =>
            "/api/constant-classes/s",
        "cascade_ws_constants\T" =>
            "/api/constant-classes/t",
        "cascade_ws_constants\AuditTypes" =>
            "/api/constant-classes/audit-types",
        "cascade_ws_constants\BooleanValues" =>
            "/api/constant-classes/boolean-values",
        "cascade_ws_constants\LevelValues" =>
            "/api/constant-classes/level-values",

    );
    
    foreach( $class_page_array as $class_name => $page_path )
    {
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );  
        $page->setText(
            "main-group;wysiwyg",
            u\ReflectionUtility::getClassDocumentation( $class_name )
        )->edit()->publish();
    }
    
    // publish the index page
    $page_id = $service->createId( a\Page::TYPE,  "/api/constant-classes/index", $site_name );
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