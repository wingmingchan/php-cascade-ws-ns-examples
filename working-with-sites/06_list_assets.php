<?php
/*
This program shows how to list all assets in some container or other.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-database";
    $site_obj  = $cascade->getSite( $site_name );
    $base_at   = $site_obj->getAssetTree();
    
    // output an unordered list of assets in base folder
    //echo $base_at->toListString();
    
    // output XML instead
    //u\DebugUtility::dump( u\XmlUtility::replaceBrackets( $base_at->toXml() ) );
    
    $afc_at = $site_obj->getRootAssetFactoryContainer()->getAssetTree();
    echo $afc_at->toListString();
    
    $msc_at = $site_obj->getRootMetadataSetContainer()->getAssetTree();
    echo $msc_at->toListString();
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
    echo u\StringUtility::getCoalescedString( $m->getEndDate() ), BR;

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump();
*/
?>