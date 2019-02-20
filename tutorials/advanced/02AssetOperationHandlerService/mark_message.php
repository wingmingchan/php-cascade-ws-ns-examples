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
    $id = "5b68a9d88b7ffe8364375ac779f042bb";
    $service->markMessage( 
        $service->createIdWithIdType( $id, c\T::MESSAGE ), 
        c\T::UNREAD );

    if( $service->isSuccessful() )
    {
        echo "Marked message successfully<br />";
    }
    else
    {
        echo "Failed to mark message. " . $service->getMessage();
    }
    
    $service->printLastRequest();
    $service->printLastResponse();
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