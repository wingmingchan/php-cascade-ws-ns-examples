<?php
//require_once('auth_tutorial7.php');
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
$mode = 'set-global';
//$mode = 'set-site';
//$mode = 'raw';
$mode = 'none';

try
{
    //$r = $cascade->getAsset( a\Role::TYPE, 210 )->dump();
    //$r = $cascade->getRoleAssetByName( "Account Manager" )->dump();
    u\DebugUtility::dump( $cascade->getRoles() );

    $r = $cascade->getAsset( a\Role::TYPE, 110 ); // global role
    //$r = $cascade->getAsset( a\Role::TYPE, 210 ); // site role
    
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
                    setAccessAdminArea( false )->
                    setAccessAssetFactories( false )->
                    setAccessAudits( false )->
                    setAccessConfigurationSets( false )->
                    setAccessContentTypes( false )->
                    setAccessDataDefinitions( false )->
                    setAccessMetadataSets( false )->
                    setAccessPublishSets( false )->
                    setAccessTransports( false )->
                    setAccessWorkflowDefinitions( false )->
                    setActivateDeleteVersions( false )->
                    setAlwaysAllowedToToggleDataChecks( false )->
                    setAssignApproveWorkflowSteps( false )->
                    setBulkChange( false )->
                    setBypassWorkflow( false )->
                    setBreakLocks( false )->
                    setAssignWorkflowsToFolders( false )->
                    setBypassAssetFactoryGroupsNewMenu( false )->
                    setBypassDestinationGroupsWhenPublishing( false )->
                    setBypassWorkflowDefintionGroupsForFolders( false )->
                    setBypassAllPermissionsChecks( false )->
                    setCancelPublishJobs( false )->
                    setDeleteWorkflows( false )->
                    setDiagnosticTests( false )->
                    setEditAccessRights( false )->
                    setEditDataDefinition( false )->
                    setEditPageContentType( false )->
                    setEditPageLevelConfigurations( false )->
                    setIntegrateFolder( false )->
                    setImportZipArchive( false )->
                    setMoveRenameAssets( false )->
                    setMultiSelectCopy( false )->
                    setMultiSelectDelete( false )->
                    setMultiSelectMove( false )->
                    setMultiSelectPublish( false )->
                    setPublishReadableAdminAreaAssets( false )->
                    setPublishReadableHomeAssets( false )->
                    setPublishWritableAdminAreaAssets( false )->
                    setPublishWritableHomeAssets( false )->
                    setRecycleBinDeleteAssets( false )->
                    setRecycleBinViewRestoreAllAssets( false )->
                    setRecycleBinViewRestoreUserAssets( false )->
                    setReorderPublishQueue( false )->
                    setSendStaleAssetNotifications( false )->
                    setUploadImagesFromWysiwyg( false )->
                    setViewPublishQueue( false )->
                    setViewVersions( false )->
                    
                    // method from class
                    setAccessAllSites( false )->
                    setAccessConfiguration( false )->
                    setAccessRoles( false )->
                    setAccessSecurityArea( false )->
                    setAccessSiteManagement( false )->
                    setAccessTargetsDestinations( false )->
                    setBroadcastMessages( false )->
                    setConfigureLogging( false )->
                    setCreateGroups( false )->
                    setCreateRoles( false )->
                    setCreateSites( false )->
                    setCreateUsers( false )->
                    setDatabaseExportTool( false )->
                    setDeleteAllUsers( false )->
                    setDeleteAnyGroup( false )->
                    setDeleteMemberGroups( false )->
                    setDeleteUsersInMemberGroups( false )->
                    setEditAnyGroup( false )->
                    setEditAnyUser( false )->
                    setEditMemberGroups( false )->
                    setEditSystemPreferences( false )->
                    setEditUsersInMemberGroups( false )->
                    setForceLogout( false )->
                    setNewSiteWizard( false )->
                    setOptimizeDatabase( false )->
                    setPathRepairTool( false )->
                    setRecycleBinChecker( false )->
                    setSearchingIndexing( false )->
                    setSyncLdap( false )->
                    setViewSystemInfoAndLogs( false )->
                    setSiteMigration( false )->
                    setViewAllGroups( false )->
                    setViewAllUsers( false )->
                    setViewMemberGroups( false )->
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
                    setAccessAdminArea( false )->
                    setAccessAssetFactories( false )->
                    setAccessAudits( false )->
                    setAccessConfigurationSets( false )->
                    setAccessContentTypes( false )->
                    setAccessDataDefinitions( false )->
                    setAccessMetadataSets( false )->
                    setAccessPublishSets( false )->
                    setAccessTransports( false )->
                    setAccessWorkflowDefinitions( false )->
                    setActivateDeleteVersions( false )->
                    setAlwaysAllowedToToggleDataChecks( false )->
                    setAssignApproveWorkflowSteps( false )->
                    setBulkChange( false )->
                    setBypassWorkflow( false )->
                    setBreakLocks( false )->
                    setAssignWorkflowsToFolders( false )->
                    setBypassAssetFactoryGroupsNewMenu( false )->
                    setBypassDestinationGroupsWhenPublishing( false )->
                    setBypassWorkflowDefintionGroupsForFolders( false )->
                    setBypassAllPermissionsChecks( false )->
                    setCancelPublishJobs( false )->
                    setDeleteWorkflows( false )->
                    setDiagnosticTests( false )->
                    setEditAccessRights( false )->
                    setEditDataDefinition( false )->
                    setEditPageContentType( false )->
                    setEditPageLevelConfigurations( false )->
                    setIntegrateFolder( false )->
                    setImportZipArchive( false )->
                    setMoveRenameAssets( false )->
                    setMultiSelectCopy( false )->
                    setMultiSelectDelete( false )->
                    setMultiSelectMove( false )->
                    setMultiSelectPublish( false )->
                    setPublishReadableAdminAreaAssets( false )->
                    setPublishReadableHomeAssets( false )->
                    setPublishWritableAdminAreaAssets( false )->
                    setPublishWritableHomeAssets( false )->
                    setRecycleBinDeleteAssets( false )->
                    setRecycleBinViewRestoreAllAssets( false )->
                    setRecycleBinViewRestoreUserAssets( false )->
                    setReorderPublishQueue( false )->
                    setSendStaleAssetNotifications( false )->
                    setUploadImagesFromWysiwyg( false )->
                    setViewPublishQueue( false )->
                    setViewVersions( false )->
                    
                    // method from class
                    setAccessConnectors( false )->
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
                
            u\DebugUtility::dump( $r_std );
       
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Role" );
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