<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'raw';

try
{
    $id = "64f4f31c8b7f085600ae2282dddc781f"; // Test
    $wdc = $cascade->getAsset( a\WorkflowDefinitionContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $wdc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wdc->dump( true );
            
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
            
            echo S_PRE;
            var_dump( $wdc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $wdc_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWDEFINITIONCONTAINER, $id ), 
                    c\P::WORKFLOWDEFINITIONCONTAINER );
            
            echo S_PRE;
            var_dump( $wdc_std );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
