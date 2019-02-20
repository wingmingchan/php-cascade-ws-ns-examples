<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "ALL-USERS";
    
    $group = $service->retrieve( $service->createId( a\Group::TYPE, $group_name ) );

    if( $service->isSuccessful() )
    {
        echo "Read successfully";
        u\DebugUtility::dump( $group );
        
        $users = explode( ";", $group->users );
        u\DebugUtility::dump( $users );
    }
    else
        echo "Failed to read. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>