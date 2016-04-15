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
//$mode = 'set';
//$mode = 'raw';

try
{
    $id  = "65221ba58b7f085600ae22825f36b20e"; // Test Workflow
    $wfd = $cascade->getAsset( a\WorkflowDefinition::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $wfd->display();
            $wfd->displayXml();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wfd->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $wfd->getId() . BR .
                 "Name: " . $wfd->getName() . BR .
                 "Copy: " . ( $wfd->getCopy() ? 'true' : 'false' ) . BR .
                 "Create: " . ( $wfd->getCreate() ? 'true' : 'false' ) . BR .
                 "Delete: " . ( $wfd->getDelete() ? 'true' : 'false' ) . BR .
                 "Edit: " . ( $wfd->getEdit() ? 'true' : 'false' ) . BR .
                 "";
                 
            echo S_PRE;
            var_dump( $wfd->getOrderedStep( 'initialize' ) );
            echo E_PRE;            

            if( $mode != 'all' )
                break;
             
        case 'set':
            $wfd->setNamingBehavior( 
                a\WorkflowDefinition::NAMING_BEHAVIOR_DEFINITION )->
                setEdit( false )->
                addGroup( $cascade->getAsset( a\Group::TYPE, 'demo' ) )->
                edit();
                
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $wfd_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWDEFINITION, $id ), c\P::WORKFLOWDEFINITION );
            echo S_PRE;
            var_dump( $wfd_std );
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
