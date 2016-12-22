<?php
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $id = '66654e068b7f08ee762e79cb9885dd62';
    $p  = $cascade->getAsset( a\Page::TYPE, $id );
    $wf = $p->getWorkflow();
    $wd = $cascade->getAsset( 
        a\WorkflowDefinition::TYPE, '214826888b7f08ee00470c646e2e9f25' );
        
    // no work flow, start a new one
    if( $wf == NULL || $wf->getCurrentStep() == 'finish' )
    {
        echo "Initializing a new workflow." . BR;
        $p->edit( NULL, $wd, "New Workflow", "Testing comment" );
    }
    else
    {
        $current_step = $wf->getCurrentStep();
        echo "Current step: " . $current_step . BR;
        echo $wf->getId(), BR;
        echo $wf->getName(), BR;
        u\DebugUtility::dump( $wf->getRelatedEntity() );
        echo $wf->getStartDate(), BR;
        echo $wf->getEndDate(), BR;
        echo u\StringUtility::boolToString( $wf->isPossibleAction( "edit-now" ) );
    }
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