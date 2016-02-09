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
    $service->listSites();
        
    if( $service->isSuccessful() )
    {
        echo "Listed sites successfully" . BR;
        u\DebugUtility::dump( $service->getReply() );
    }
    else
        echo "Failed to list subscribers. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>