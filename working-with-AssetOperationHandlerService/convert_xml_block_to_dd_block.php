<?php
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // get two blocks
    $xml_block = $cascade->getAsset(
        a\XmlBlock::TYPE, "970d2ef08b7f08ee3df073c8df057b89" );
    $dd_block = $cascade->getAsset(
        a\DataBlock::TYPE, "0b3aaa208b7f08ee5a4fada2258d6fb9" );
        
    // read the property of the xml block so that we can keep the id, metadata, etc.
    $property = $xml_block->getProperty();
    // remove xml property
    unset( $property->xml );
    // read property from dd block and store it in property of xml block
    $property->structuredData = $dd_block->getProperty()->structuredData;
    $property->xhtml = null;
    // create new asset
    $asset = new \stdClass();
    $asset->xhtmlDataDefinitionBlock = $property;
    // submit
    $service->edit( $asset );
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