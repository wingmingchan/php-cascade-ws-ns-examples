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
    $folder1 = $cascade->getAsset( a\Folder::TYPE, "1f229ee38b7ffe834c5fe91e89724940" );
    $folder1->deleteAllChildren();
    
    $folder2 = $cascade->getAsset( a\Folder::TYPE, "1f22a5c48b7ffe834c5fe91ed438e192" );
    u\DebugUtility::dump( $folder2->getChildren() );
    u\DebugUtility::dump( $folder2->getContainerChildrenIds() );
    
    $folder2->getMetadata()->setDisplayName( "Test" )->getHostAsset()->edit();
    
    //u\DebugUtility::dump( $folder2->getAssetTree() );
    
    echo u\StringUtility::boolToString( $folder2->isAncestorOf( $folder1) ), BR;
    echo u\StringUtility::boolToString( $folder2->isParentOf( $folder1) ), BR;
    
    u\DebugUtility::dump( $folder2->toChild() );
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Container" );
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