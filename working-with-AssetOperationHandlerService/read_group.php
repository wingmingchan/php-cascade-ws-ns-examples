<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "cru";
    
    $group = $service->retrieve( $service->createId( a\Group::TYPE, $group_name ) );

    if( $service->isSuccessful() )
    {
        echo "Read successfully";
        u\DebugUtility::dump( $group );
    }
    else
        echo "Failed to read. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>