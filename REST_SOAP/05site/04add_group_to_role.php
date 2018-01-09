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
    $site  = $cascade->getSite( "about-test" );
    $group = $cascade->getAsset( a\Group::TYPE, "test-ws-group" );
    $role  = $cascade->getAsset( a\Role::TYPE, 271 );
    
    $site->addGroupToRole( $role, $group )->edit()->dump();
    
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