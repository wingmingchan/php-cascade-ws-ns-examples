<?php
require_once( 'auth_REST_SOAP.php' );
require_once( 'role_constants.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_role = $cascade->getAsset( a\Role::TYPE, 271 );
    $site_abilities = $site_role->getSiteAbilities();
    $site_abilities->
        setAccessAssetFactories( true )->
        setAccessAudits( true )->
        setAccessConfigurationSets( true )->
        setAccessConnectors( true )->
        setAccessContentTypes( true )->
        setAccessDataDefinitions( true )->
        setAccessDestinations( true )->
        setAccessEditorConfigurations( true )->
        setAccessManageSiteArea( true )->
        setAccessMetadataSets( true )->
        setAccessPublishSets( true )->
        setAccessTransports( true )->
        setAccessWorkflowDefinitions( true )->
        setActivateDeleteVersions( true )->
        setAlwaysAllowedToToggleDataChecks( true )->
        setAssignApproveWorkflowSteps( true )->
        setAssignWorkflowsToFolders( true )->
        setBreakLocks( true )->
        setBrokenLinkReportAccess( true )->
        setBrokenLinkReportMarkFixed( true )->
        setBulkChange( true )->
        setBypassAllPermissionsChecks( true )->
        setBypassAssetFactoryGroupsNewMenu( true )->
        setBypassDestinationGroupsWhenPublishing( true )->
        setBypassWorkflow( true )->
        setBypassWorkflowDefintionGroupsForFolders( true )->
        setBypassWysiwygEditorRestrictions( true )->
        setCancelPublishJobs( true )->
        setDeleteWorkflows( true )->
        setDiagnosticTests( true )->
        setEditAccessRights( true )->
        setEditDataDefinition( true )->
        setEditPageContentType( true )->
        setEditPageLevelConfigurations( true )->
        setImportZipArchive( true )->
        setMoveRenameAssets( true )->
        setMultiSelectCopy( true )->
        setMultiSelectDelete( true )->
        setMultiSelectMove( true )->
        setMultiSelectPublish( true )->
        setPublishReadableAdminAreaAssets( true )->
        setPublishReadableHomeAssets( true )->
        setPublishWritableAdminAreaAssets( true )->
        setPublishWritableHomeAssets( true )->
        setRecycleBinDeleteAssets( true )->
        setRecycleBinViewRestoreAllAssets( true )->
        setRecycleBinViewRestoreUserAssets( true )->
        setReorderPublishQueue( true )->
        setSendStaleAssetNotifications( true )->
        setUploadImagesFromWysiwyg( true )->
        setViewPublishQueue( true )->
        setViewVersions( true );
    $site_role->edit()->dumpJSON();

    if( !$soap )
    {
        u\DebugUtility::dump( $service->getCommands() );
        // clean up
        $service->clearCommands();
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