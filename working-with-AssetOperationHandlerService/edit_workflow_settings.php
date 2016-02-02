<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-admin";
    $service->readWorkflowSettings( 
        $service->createId( a\Folder::TYPE, "/", $site_name ) );

    if($service->isSuccessful())
    {
        echo "Read successfully", BR;
        $reply            = $service->getReply();
        $workflowSettings = 
            $reply->readWorkflowSettingsReturn->workflowSettings;
    
        $workflow_id = $service->createId( a\WorkflowDefinition::TYPE, 
            '/Email Workflow', $site_name );
    
        $workflowdefinitions[] = $workflow_id;
        $workflowSettings->workflowDefinitions = $workflowdefinitions;
    
        $workflowSettings->inheritWorkflows = false;
        $workflowSettings->requireWorkflow  = false;
    
        $service->editWorkflowSettings( $workflowSettings, false, false );
    }
    else
        echo "Failed to read. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>