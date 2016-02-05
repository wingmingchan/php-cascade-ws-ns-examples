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
    $mode = 'page';
    
    // check if the workflow definition exists
    $common_site_name  = '_common';
    $site_name         = 'cascade-admin';
    $wd_name           = 'Unpublish and Delete';
    $wd_container_name = '/';
    
    $wd = $cascade->getWorkflowDefinition(
        $wd_name,
        $common_site_name );
        
    if( is_null( $wd ) )
    {
        // create the workflow definition
        $wd_container = $cascade->getAsset( 
            a\WorkflowDefinitionContainer::TYPE,
            $wd_container_name,
            $common_site_name );
            
        $xml =
<<<WFXML
<system-workflow-definition name="Unpublish and Delete" initial-step="initialize" >
    <triggers>
        <trigger name="AssignStepIfUser" class="com.cms.workflow.function.AssignStepIfUser" />
        <trigger name="AssignToGroupOwningAsset" class="com.cms.workflow.function.AssignToGroupOwningAsset" />
        <trigger name="AssignToSpecifiedGroup" class="com.cms.workflow.function.AssignToSpecifiedGroup" />
        <trigger name="AssignToWorkflowOwner" class="com.cms.workflow.function.AssignToWorkflowOwner" />
        <trigger name="CopyFolder" class="com.cms.workflow.function.CopyFolder" />
        <trigger name="com.cms.workflow.function.CreateNewWorkflowTrigger" class="com.cms.workflow.function.CreateNewWorkflowTrigger" />
        <trigger name="Delete" class="com.cms.workflow.function.Delete" />
        <trigger name="UnpublishAndDelete" class="com.cms.workflow.function.DeleteAndUnpublish" />
        <trigger name="DeleteParentFolder" class="com.cms.workflow.function.DeleteParentFolderTrigger" />
        <trigger name="Email" class="com.cms.workflow.function.EmailProvider" />
        <trigger name="Merge" class="com.cms.workflow.function.Merge" />
        <trigger name="PreserveCurrentUser" class="com.cms.workflow.function.PreserveCurrentUser" />
        <trigger name="PublishContainingPublishSet" class="com.cms.workflow.function.PublishContainingPublishSetTrigger" />
        <trigger name="PublishParentFolder" class="com.cms.workflow.function.PublishParentFolderTrigger" />
        <trigger name="PublishSet" class="com.cms.workflow.function.PublishSetTrigger" />
        <trigger name="Publish" class="com.cms.workflow.function.Publisher" />
        <trigger name="Version" class="com.cms.workflow.function.Version" />
        <trigger name="CreateNewWorkflow" class="com.cms.workflow.function.CreateNewWorkflowsTrigger" />
    </triggers>
    <steps>
        <step type="system" identifier="initialize" label="Initialization" >
            <actions>
                <action identifier="publish" label="Publish" move="forward" >
                    <trigger name="UnpublishAndDelete" />
                </action>
            </actions>
        </step>
        <step type="system" identifier="finished" label="Finished" />
    </steps>
    <non-ordered-steps/>
</system-workflow-definition>
WFXML;
        $cascade->createWorkflowDefinition(
            $wd_container,
            $wd_name,
            a\WorkflowDefinition::NAMING_BEHAVIOR_AUTO, // naming behavior
            $xml
        )->
        setCopy(   false )->
        setCreate( false )->
        setDelete( true )->
        setEdit(   false )->
        edit();
    }
    
    switch( $mode )
    {
        case 'page':
            // unpublish and delete a page
            // by attaching the workflow definition to the page
            $cascade->getAsset( a\Page::TYPE, 'test31', $site_name )->
                edit( null, $wd, "Delete and Unpublish", "Comment", false );
            break;
            
        case 'file':
            // unpublish and delete a file
            // by attaching the workflow definition to the file
            $cascade->getAsset( a\File::TYPE, 'files/01a.zip', $site_name )->
                edit( null, $wd, "Delete and Unpublish", "Comment" );
            break;
    }
} 
catch( \Exception $e ) 
{ 
    echo S_PRE . $e . E_PRE; 
} 
?>