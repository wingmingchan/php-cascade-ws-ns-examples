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
    $mid = "9e10ae5b8b7ffe8364375ac78e212e42";
    $service->deleteMessage( $service->createId( c\T::MESSAGE, $mid ) );
    
    if( $service->isSuccessful() )
        echo "Deleted successfully";
    else
        echo "Failed to delete. " . $service->getMessage();
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