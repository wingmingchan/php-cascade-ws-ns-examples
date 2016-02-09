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
    $folder_path = "pdf";
    
    $ws = $service->readWorkflowSettings( $service->createId( a\Folder::TYPE, $folder_path, "cascade-admin" ) );

    if( $service->isSuccessful() )
    {
        echo "Read successfully";
        u\DebugUtility::dump( $ws );
    }
    else
        echo "Failed to read. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>