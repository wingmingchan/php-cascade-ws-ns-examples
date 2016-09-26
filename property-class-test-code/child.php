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
    // create an identifier stdClass object
    $id_std = $service->createId( 
        a\Folder::TYPE, "cc1e51808b7ffe8364375ac78ba27f05" );
    u\DebugUtility::dump( $id_std );
    
    // create a Child object
    $id_child = new p\Child( $id_std );
    u\DebugUtility::dump( $id_child );
    u\DebugUtility::dump( $id_child->toStdClass() );
    
    // read the asset
    $folder = $id_child->getAsset( $service );
    
    // list the content of the folder
    $children = $folder->getChildren();
    u\DebugUtility::dump( $children );
    
    // display each child
    foreach( $children as $child )
    {
        $child->display();
        echo $child->getId(), BR;
        echo $child->getType(), BR;
        echo $child->getPathPath(), BR;
        echo $child->getPathSiteId(), BR;
        echo u\StringUtility::getCoalescedString( $child->getPathSiteName() ), BR;
        echo u\StringUtility::boolToString( $child->getRecycled() ), BR;
        u\DebugUtility::dump( $child->getPath()->toStdClass() );
    }
    
    u\ReflectionUtility::showMethodSignatures(
        "cascade_ws_property\Identifier" );
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_property\Path" );
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