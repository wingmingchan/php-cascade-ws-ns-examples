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
    $site = $cascade->getSite( "about-test" );
    $user = $cascade->getAsset( a\User::TYPE, "test-ws-user" );
    $role = $cascade->getAsset( a\Role::TYPE, 271 );
    
    $site->addUserToRole( $role, $user )->edit()->dump();
    
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