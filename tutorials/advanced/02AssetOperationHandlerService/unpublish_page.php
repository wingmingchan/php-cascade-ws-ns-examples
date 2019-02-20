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
    $page_path = "projects/web-services/reports/creating-format";
    
    $service->unpublish( $service->createId( a\Page::TYPE, $page_path, "cascade-admin" ) );

    if( $service->isSuccessful() )
        echo "Unpublished successfully";
    else
        echo "Failed to unpublish. " . $service->getMessage();
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