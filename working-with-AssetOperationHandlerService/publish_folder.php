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
    $folder_path = "projects/web-services/reports";
    
    $service->publish( $service->createId( a\Folder::TYPE, $folder_path, "cascade-admin" ) );

    if( $service->isSuccessful() )
        echo "Published successfully";
    else
        echo "Failed to publish. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>