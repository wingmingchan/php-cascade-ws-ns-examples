<?php
/*
A role can be either global or site. They define different abilities.
Use getRoleType to get the type string.
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
    // global
    //$role = $cascade->getRole( $global_role_id );
    $role = $cascade->getRole( 5 );
    echo $role->getRoleType(), BR;
    
    // site
    //$role = $cascade->getRole( $site_role_id );
    //echo $role->getRoleType(), BR;
    
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