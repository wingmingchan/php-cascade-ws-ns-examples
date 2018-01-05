<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "test-ws-group";
    $role_name  = "Test WS Site Role;Default";
    $group      = $cascade->getGroup( $group_name );

    if( isset( $group ) )
        $cascade->deleteAsset( $group );
    
    $group = $cascade->createGroup( $group_name, $role_name );
    $group->dump();
    
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