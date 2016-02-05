<?php
/*
Setup:
1. create a workflow defintion with ordered steps and actions for Edit
2. Associate the workflow defintion with a folder containing pages
3. Edit one of the pages to start the workflow
4. Run this program
*/
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $path = '/projects/web-services/reports/creating-format';
    
    $service->readWorkflowInformation( 
    $service->createId( a\Page::TYPE, $path, "cascade-admin" ) );
    
    if( $service->isSuccessful() )
    {
        echo "Successfully read workflow information<br />";
        
        $workflow      = 
            $service->getReply()->readWorkflowInformationReturn->workflow;
        $id            = $workflow->id;
        $current_step  = $workflow->currentStep;
        $ordered_steps = $workflow->orderedSteps;
        
        if( is_array( $ordered_steps->step ) )
        {
            $step_count = count( $ordered_steps->step );
            
            // find the current step
            for( $i = 0; $i < $step_count; $i++ )
            {
                $cur_step = $ordered_steps->step[$i];
                
                if( $cur_step->identifier != $current_step )
                    continue;
                else
                {
                    echo "Current step: $current_step", BR;
                    $actions = $cur_step->actions;
                    
                    if( isset( $actions->action)  )
                    {
                        if( is_array( $actions->action ) )
                        {
                            $action = $actions->action[0]->identifier;
                        }
                        else
                        {
                            $action = $actions->action->identifier;
                        }
                        break;
                    }
                }
            }
        }
        
        if( isset( $action ) )
        {
            echo "Action: $action", BR;
            $service->performWorkflowTransition( $id, $action, 'Testing' );
        
            if( $service->isSuccessful() )
            {
                echo "Performed workflow transition successfully<br />";
            }
            else
            {
                echo "Failed to perform workflow transition. " .
                    $service->getMessage();
            }
        }
        else
        {
            echo "No possible action defined", BR;
        }
    }
    else
    {
        echo "Failed to read workflow transition. " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo $e;
}
?>