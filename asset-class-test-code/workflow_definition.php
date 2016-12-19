<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
$mode = 'get';
$mode = 'set';
//$mode = 'raw';
//$mode = 'none';

try
{
    $id  = "1f2421778b7ffe834c5fe91e46bef804"; // Test Workflow
    $wfd = $cascade->getAsset( a\WorkflowDefinition::TYPE, $id )->dump() ;
    
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
                 
                 
                 "Copy: " . u\StringUtility::boolToString( $wfd->getCopy() ), BR,
                 "Create: " . u\StringUtility::boolToString( $wfd->getCreate() ), BR,
                 "Delete: " . u\StringUtility::boolToString( $wfd->getDelete() ), BR,
                 "Edit: " . u\StringUtility::boolToString( $wfd->getEdit() ), BR,
                 "";
                 
            echo u\StringUtility::getCoalescedString( $wfd->getApplicableGroups() ), BR;
            echo $wfd->getNamingBehavior(), BR;
                 
            /*
            u\DebugUtility::dump( $wfd->getOrderedStep( 'initialize' ) );
            u\DebugUtility::dump( $wfd->getOrderedSteps() );
            u\DebugUtility::dump( $wfd->getNonOrderedStep( 'edit' ) );
            u\DebugUtility::dump( $wfd->getNonOrderedSteps() );
            u\DebugUtility::dump( u\XmlUtility::replaceBrackets( $wfd->getXml() ) );
            */
            
            echo u\StringUtility::boolToString( $wfd->hasNonOrderedStep( 'edit' ) ), BR;
            echo u\StringUtility::boolToString( $wfd->hasOrderedStep( 'initialize' ) ), BR;
            echo u\StringUtility::boolToString( $wfd->isApplicableToGroup(
                $cascade->getAsset( a\Group::TYPE, "Administrators" )
            ) ), BR;

            if( $mode != 'all' )
                break;
             
        case 'set':
            $wfd->setNamingBehavior( 
                    a\WorkflowDefinition::NAMING_BEHAVIOR_DEFINITION )->
                setEdit( false )->
                addGroup( $cascade->getAsset( a\Group::TYPE, 'demo' ) )->
                setCopy( true )->
                setCreate( true )->
                setDelete( true )->
                setEdit( true )->
                
                
                edit()->dump();
                
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $wfd_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORKFLOWDEFINITION, $id ), c\P::WORKFLOWDEFINITION );

            u\DebugUtility::dump( $wfd_std );

       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\WorkflowDefinition" );
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