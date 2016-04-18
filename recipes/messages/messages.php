<?php
require_once('cascade_ws_ns/auth_chanw.php');
    
use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$option = 2;

try
{
    switch( $option )
    {
        // list all messages
        case "1":
            $all_messages = $cascade->getAllMessages();
            $msg_count    = count( $all_messages );
            
            echo "<p>There are $msg_count messages.</p>";
            
            for( $i = 0; $i < $msg_count; $i++ )
            {
                $temp_count = $i + 1;
                echo "<h2>Message $temp_count</h2>";
                echo "<h3>Subject: " . $all_messages[$i]->getSubject() . "</h3>";
                echo $all_messages[$i]->getBody();
            }
            
            break;
            
        // delete all messages
        case "2":
            $all_messages = $cascade->getAllMessages();
            $msg_count    = count( $all_messages );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to delete<br />";
                break;
            }
            
            $cascade->deleteAllMessages();
            echo "Successfully deleted all messages<br />";
            
            break;
            
        // display all publish messages without issues
        case "3":
            $pub_msg_no_issues = $cascade->getPublishMessagesWithoutIssues();
            $msg_count = count( $pub_msg_no_issues );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to display<br />";
                break;
            }
            
            for( $i = 0; $i < $msg_count; $i++ )
            {
                $temp_count = $i + 1;
                echo "<h2>Message $temp_count</h2>";
                echo "<h3>Subject: " . $pub_msg_no_issues[$i]->getSubject() . "</h3>";
                echo $pub_msg_no_issues[$i]->getBody();
            }
            
            break;
            
        // delete all publish messages without issues
        case "4":
            $pub_msg_no_issues = $cascade->getPublishMessagesWithoutIssues();
            $msg_count = count( $pub_msg_no_issues );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to delete<br />";
                break;
            }

            $cascade->deletePublishMessagesWithoutIssues();
            echo "Successfully deleted all publish messages without issues<br />"; 

            break;
            
        // display all summary messages without failures
        case "5":
            $sum_msg_no_failures = $cascade->getSummaryMessagesNoFailures();
            $msg_count = count( $sum_msg_no_failures );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to display<br />";
                break;
            }
            
            for( $i = 0; $i < $msg_count; $i++ )
            {
                $temp_count = $i + 1;
                echo "<h2>Message $temp_count</h2>";
                echo "<h3>Subject: " . $sum_msg_no_failures[$i]->getSubject() . "</h3>";
                echo $sum_msg_no_failures[$i]->getBody();
            }
            
            break;
            
        // delete all summary messages without failures
        case "6":
            $sum_msg_no_failures = $cascade->getSummaryMessagesNoFailures();
            $msg_count = count( $sum_msg_no_failures );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to delete<br />";
                break;
            }

            $cascade->deleteSummaryMessagesNoFailures();
            echo "Successfully deleted all summary messages without failures<br />"; 

            break;  
            
        // delete all unpublish messages without issues
        case "7":
            $unpub_msg_no_issues = $cascade->getUnpublishMessagesWithoutIssues();
            $msg_count = count( $unpub_msg_no_issues );
            
            if( $msg_count == 0 )
            {
                echo "There are no messages to delete<br />";
                break;
            }
            
            $cascade->deleteUnpublishMessagesWithoutIssues();            
            echo "Successfully deleted all unpublish messages without issues<br />";
            
            break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>