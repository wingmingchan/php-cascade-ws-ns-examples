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
    $f  = $cascade->getAsset(
        a\Folder::TYPE, "39d53c648b7ffe834c5fe91ec0cb0f27"
    );
    
    $wd_id = "9fe9a65e8b7ffe83164c9314b8a987d9";
    $wd    = $cascade->getAsset( a\WorkflowDefinition::TYPE, $wd_id );
    
    $ws = $f->getWorkflowSettings();
    $ws->setInheritWorkflows( true )->setRequireWorkflow( false );
/*   
    // toggle
    if( $ws->hasWorkflowDefinition( $wd_id ) )
        $ws->removeWorkflowDefinition( $wd );
    else
        $ws->addWorkflowDefinition( $wd );
*/         
    $f->editWorkflowSettings( true, true );

    u\DebugUtility::dump( $ws->toStdClass() );
    
    u\DebugUtility::dump( $ws->getWorkflowDefinitions() );
    u\DebugUtility::dump( $ws->getInheritedWorkflowDefinitions() );
    u\DebugUtility::out( u\StringUtility::boolToString( $ws->getInheritWorkflows() ) );
    u\DebugUtility::out( u\StringUtility::boolToString( $ws->getRequireWorkflow() ) );
    
    $ws = $f->getWorkflowSettings();
    $ws->unsetInheritWorkflows();
    u\DebugUtility::dump( $ws->toStdClass() );
	$f->editWorkflowSettings( true, true );
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