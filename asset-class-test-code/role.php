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
//$mode = 'set-global';
//$mode = 'set-site';
//$mode = 'raw';

try
{
    $r = $cascade->getAsset( a\Role::TYPE, 110 ); // global role
    //$r = $cascade->getAsset( a\Role::TYPE, 55 ); // site role
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $r->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $r->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $r->getId() . BR;
            
            $ga = $r->getGlobalAbilities();
            
            if( $ga != NULL )
            {
                echo S_PRE;
                var_dump( $ga->toStdClass() );
                echo E_PRE;
            }
            
            $sa = $r->getSiteAbilities();
            
            if( $sa != NULL )
            {
                echo S_PRE;
                var_dump( $sa->toStdClass() );
                echo E_PRE;
            }

            if( $mode != 'all' )
                break;
        
        case 'set-global':
            $ga = $r->getGlobalAbilities();
            
            if( $ga != NULL )
            {
                $ga->
                    // methods from parent
                    setAccessAdminArea( true )->
                    setAccessAssetFactories( true )->
                    setAccessAudits( true )->
                    setAccessConfigurationSets( true )->
                    setAccessContentTypes( true )->
                    setAccessDataDefinitions( true )->
                    setAccessMetadataSets( true )->
                    setAccessPublishSets( true )->
                    setAccessTransports( true )->
                    setAccessWorkflowDefinitions( true )->
                    setActivateDeleteVersions( true )->
                    setAlwaysAllowedToToggleDataChecks( true )->
                    setAssignApproveWorkflowSteps( true )->
                    setBulkChange( true )->
                    setBypassWorkflow( true )->
                    setBreakLocks( true )->
                    setAssignWorkflowsToFolders( true )->
                    setBypassAssetFactoryGroupsNewMenu( true )->
                    setBypassDestinationGroupsWhenPublishing( true )->
                    setBypassWorkflowDefintionGroupsForFolders( true )->
                    setBypassAllPermissionsChecks( true )->
                    setCancelPublishJobs( true )->
                    setDeleteWorkflows( true )->
                    setDiagnosticTests( true )->
                    setEditAccessRights( true )->
                    setEditDataDefinition( true )->
                    setEditPageContentType( true )->
                    setEditPageLevelConfigurations( true )->
                    setIntegrateFolder( true )->
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
                    setViewVersions( true )->
                    
                    // method from class
                    setAccessAllSites( true )->
                    setAccessConfiguration( true )->
                    setAccessRoles( true )->
                    setAccessSecurityArea( true )->
                    setAccessSiteManagement( true )->
                    setAccessTargetsDestinations( true )->
                    setBroadcastMessages( true )->
                    setConfigureLogging( true )->
                    setCreateGroups( true )->
                    setCreateRoles( true )->
                    setCreateSites( true )->
                    setCreateUsers( true )->
                    setDatabaseExportTool( true )->
                    setDeleteAllUsers( true )->
                    setDeleteAnyGroup( true )->
                    setDeleteMemberGroups( true )->
                    setDeleteUsersInMemberGroups( true )->
                    setEditAnyGroup( true )->
                    setEditAnyUser( true )->
                    setEditMemberGroups( true )->
                    setEditSystemPreferences( true )->
                    setEditUsersInMemberGroups( true )->
                    setForceLogout( true )->
                    setNewSiteWizard( true )->
                    setOptimizeDatabase( true )->
                    setPathRepairTool( true )->
                    setRecycleBinChecker( true )->
                    setSearchingIndexing( true )->
                    setSyncLdap( true )->
                    setViewSystemInfoAndLogs( true )->
                    setSiteMigration( true )->
                    setViewAllGroups( true )->
                    setViewAllUsers( true )->
                    setViewMemberGroups( true )->
                    setViewUsersInMemberGroups( true );
                
                $r->edit();
            }

            if( $mode != 'all' )
                break;
                
        case 'set-site':
            $sa = $r->getSiteAbilities();
            
            if( $sa != NULL )
            {
                $sa->
                    // methods from parent
                    setAccessAdminArea( true )->
                    setAccessAssetFactories( true )->
                    setAccessAudits( true )->
                    setAccessConfigurationSets( true )->
                    setAccessContentTypes( true )->
                    setAccessDataDefinitions( true )->
                    setAccessMetadataSets( true )->
                    setAccessPublishSets( true )->
                    setAccessTransports( true )->
                    setAccessWorkflowDefinitions( true )->
                    setActivateDeleteVersions( true )->
                    setAlwaysAllowedToToggleDataChecks( true )->
                    setAssignApproveWorkflowSteps( true )->
                    setBulkChange( true )->
                    setBypassWorkflow( true )->
                    setBreakLocks( true )->
                    setAssignWorkflowsToFolders( true )->
                    setBypassAssetFactoryGroupsNewMenu( true )->
                    setBypassDestinationGroupsWhenPublishing( true )->
                    setBypassWorkflowDefintionGroupsForFolders( true )->
                    setBypassAllPermissionsChecks( true )->
                    setCancelPublishJobs( true )->
                    setDeleteWorkflows( true )->
                    setDiagnosticTests( true )->
                    setEditAccessRights( true )->
                    setEditDataDefinition( true )->
                    setEditPageContentType( true )->
                    setEditPageLevelConfigurations( true )->
                    setIntegrateFolder( true )->
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
                    setViewVersions( true )->
                    
                    // method from class
                    setAccessConnectors( true )->
                    setAccessDestinations( true );
                $r->edit();
            }
                    
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $r_std = $service->retrieve( $service->createId( 
                c\T::ROLE, 110 ), c\P::ROLE );
               
            //$r_std->globalAbilities->sendStaleAssetNotifications = true;
/*            
            $asset = new \stdClass();
            $asset->role = $r_std;
            $service->edit( $asset );
            
            if( $service->isSuccessful() )
            {
                echo "Edited successfully" . BR;
            }
            else
            {
                echo "Failed to edit." . BR;
            }
            
            $r_std = $service->retrieve( $service->createId( 
                c\T::ROLE, 110 ), c\P::ROLE );
*/
                
            echo S_PRE;
            var_dump( $r_std );
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
