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
	$id = "ac8e78198b7f08ee09f7a62c996243b8";
    $service->markMessage( 
        $service->createIdWithIdType( $id, c\T::MESSAGE ), 
        c\T::UNREAD );

    if( $service->isSuccessful() )
    {
        echo "Marked message successfully<br />";
    }
    else
        echo "Failed to mark message. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>