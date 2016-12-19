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
    $id = "1f2421b28b7ffe834c5fe91effa66c81"; // Test
    $wdc = $cascade->getAsset( a\WorkflowDefinitionContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $wdc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wdc->dump();
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $wdc->getId() . BR .
                 "Name: " . $wdc->getName() . BR .
                 "Path: " . $wdc->getPath() . BR .
                 "Property name: " . $wdc->getPropertyName() . BR .
                 "Site name: " . $wdc->getSiteName() . BR .
                 "Type: " . $wdc->getType() . BR .
                 "";
                 
            $children = $wdc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            u\DebugUtility::dump( $wdc->getContainerChildrenIds() );
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $wdc_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWDEFINITIONCONTAINER, $id ), 
                    c\P::WORKFLOWDEFINITIONCONTAINER );
            
            u\DebugUtility::dump( $wdc_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\WorkflowDefinitionContainer" );
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