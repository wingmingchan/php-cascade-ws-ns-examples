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
    $global_role = $cascade->getAsset( a\Role::TYPE, 270 );
    $global_abilities = $global_role->getGlobalAbilities();
    $global_abilities->
        setAccessAllSites( true )->
        // this one fails
        setAccessAudits( true )->
        setAccessConfiguration( true )->
        setAccessDefaultEditorConfiguration( true )->
        setAccessRoles( true )->
        setAccessSecurityArea( true )->
        setAccessSiteManagement( true )->
        setBroadcastMessages( true )->
        // this one fails
        setBypassAllPermissionsChecks( true )->
        setChangeIdentity( true )->
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
        setDiagnosticTests( true )->
        // this one fails
        setEditAccessRights( true )->
        setEditAnyGroup( true )->
        setEditAnyUser( true )->
        setEditMemberGroups( true )->
        setEditSystemPreferences( true )->
        setEditUsersInMemberGroups( true )->
        setForceLogout( true )->
        setOptimizeDatabase( true )->
        setSearchingIndexing( true )->
        setSyncLdap( true )->
        setViewAllGroups( true )->
        setViewAllUsers( true )->
        setViewMemberGroups( true )->
        setViewSystemInfoAndLogs( true )->
        setViewUsersInMemberGroups( true );
    $global_role->edit()->dump();

    u\DebugUtility::dumpRESTCommands( $service );    
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