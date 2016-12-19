<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'raw';

try
{
    $id = "042b48d78b7ffe8339ce5d13f348500d"; // Test
    $tc = $cascade->getAsset( a\TransportContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $tc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $tc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $tc->getId() . BR .
                 "Name: " . $tc->getName() . BR .
                 "Path: " . $tc->getPath() . BR .
                 "Property name: " . $tc->getPropertyName() . BR .
                 "Site name: " . $tc->getSiteName() . BR .
                 "Type: " . $tc->getType() . BR;
                 
            $children = $tc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $tc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $tc_std = $service->retrieve( 
                $service->createId( 
                    c\T::TRANSPORTCONTAINER, $id ), 
                    c\P::TRANSPORTCONTAINER );
            
            echo S_PRE;
            var_dump( $tc_std );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\TransportContainer" );
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