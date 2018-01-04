<?php
/*
A global role defines global abilities.
A site role defines site abilities.
Use getGlobalAbilities to get the GlobalAbilities object.
Use getSiteAbilities to get the SiteAbilities object.
*/
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
    $role_id = $global_role_id;
    $role_id = $site_role_id;
    $role    = $cascade->getRole( $role_id );
    
    if( $role->getRoleType() == "global" )
        $abilities = $role->getGlobalAbilities();
    else
        $abilities = $role->getSiteAbilities();
        
    echo $role->getRoleType(), BR;
    u\DebugUtility::dump( $abilities->toStdClass() );
    
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