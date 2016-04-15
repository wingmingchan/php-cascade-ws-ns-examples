<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    $id = '1b3b33d78b7f08ee009b967b96231d81';
    $p  = $cascade->getAsset( a\Page::TYPE, $id );
    $wf = $p->getWorkflow();
    $wd = $cascade->getAsset( 
        a\WorkflowDefinition::TYPE,
        '214826888b7f08ee00470c646e2e9f25' );
    
    // no work flow, possibly start a new one
    if( $wf == NULL || $wf->getCurrentStep() == 'finish' )
    {
        $number = rand( 1, 3 );
        
        if( $number % 3 == 0 )
        {
            echo "Initializing a new workflow." . BR;
            $p->edit( NULL, $wd, "New Workflow", "Testing comment" );
        }
        else
        {
            echo "I am too lazy to do anything." . BR;
        }
    }
    else
    {
        $current_step = $wf->getCurrentStep();
        echo "Current step: " . $current_step . BR;
        $number = rand( 1, 3 );
        
        switch( $current_step )
        {
            case 'review':
                if( $number % 3 == 0 )
                    $action = "edit-now";
                else if( $number % 3 == 1 )
                    $action = 'approve';
                else
                    $action = 'reject';
                
                if( $wf->isPossibleAction( $action ) )
                {
                    echo "Taking action: $action" . BR;
                    $wf->performWorkflowTransition( 
                        $action, "Testing transition" );
                    echo "Successfully transitioned." . BR;
                }
                break;
                
            case 'edit':
                echo "Finishing edit any minute now..." . BR;
                $p->edit( $wf, $wd, "", 
                    "Breaking out of the non-ordered step" );
                break;
        }
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>