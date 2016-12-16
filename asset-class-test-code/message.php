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
    {
    	$message = $messages[ 0 ];
        //$messages[ 0 ]->display();
        echo $message->getBody(), BR;
        echo $message->getBrokenLinks(), BR;
        echo date_format( $message->getDate(), 'Y-m-d H:i:s' ), BR;
        u\DebugUtility::dump( $message->getErrors() );
        echo $message->getFrom(), BR;
        echo $message->getTo(), BR;
        echo $message->getId(), BR;
        echo $message->getType(), BR;
        
        echo u\StringUtility::boolToString( $message->getIsComplete() ), BR;
        echo $message->getJobsWithErrors(), BR;
        echo $message->getNumberOfBrokenLinks(), BR;
        echo $message->getNumberOfJobsWithErrors(), BR;
        echo $message->getNumberOfSkippedJobs(), BR;
        echo $message->getNumberOfSuccessfulJobs(), BR;
        echo $message->getSkippedJobs(), BR;
        echo $message->getSubject(), BR;
        echo $message->getSuccessfulJobs(), BR;

        echo u\StringUtility::boolToString( $message->getWithFailures() ), BR;
        echo u\StringUtility::boolToString( $message->getWithIssues() ), BR;
    }

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