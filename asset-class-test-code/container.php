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
    $folder1 = $cascade->getAsset( a\Folder::TYPE, "e6a8b39d8b7ffe8364375ac7e4d72180" );
    $folder1->deleteAllChildren();
    
    $folder2 = $cascade->getAsset( a\Folder::TYPE, "e231348c8b7ffe8364375ac74bbbc6fb" );
    u\DebugUtility::dump( $folder2->getChildren() );
    u\DebugUtility::dump( $folder2->getContainerChildrenIds() );
    
    $folder2->getMetadata()->setDisplayName( "Test" )->getHostAsset()->edit();
    
    //u\DebugUtility::dump( $folder2->getAssetTree() );
    
    echo u\StringUtility::boolToString( $folder2->isAncestorOf( $folder1) ), BR;
    echo u\StringUtility::boolToString( $folder2->isParentOf( $folder1) ), BR;
    
    u\DebugUtility::dump( $folder2->toChild() );
    
    
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>