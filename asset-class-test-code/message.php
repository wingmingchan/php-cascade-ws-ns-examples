<?php
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $messages = $cascade->getUnpublishMessages();
    
    if( count( $messages ) > 0 )
        $messages[ 0 ]->display();

/*
    $message = $cascade->getMessage( "6ca134da8b7f08ee67a11426bae0cc0a" );
    $message->display();
    
    $cascade->deletePublishMessagesWithoutIssues();
    $cascade->deleteUnpublishMessagesWithoutIssues();
    
    $messages = $cascade->getAllMessages();
    
    foreach( $messages as $message )
    {
        $message->display();
    }
*/
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Message" );

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>