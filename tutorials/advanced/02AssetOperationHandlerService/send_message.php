<?php
/*
Note that the message sent will be displayed on the dashboard as one of the messages.
*/
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $message          = new \stdClass();
    $message->to      = 'test'; // a group
    $message->from    = 'chanw';
    $message->subject = 'test';
    $message->body    = 'This is a test. This is only a test.';
    
    $service->sendMessage( $message );

    if($service->isSuccessful())
    {
        echo "Message sent successfully<br />";
        $reply = $service->getReply();
        var_dump( $reply );
    }
    else
    {
        echo "Failed to send the message. " . $service->getMessage();
    }
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