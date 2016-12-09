<?php
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
$mode = 'display';
$mode = 'dump';
$mode = 'get';
$mode = 'set';
$mode = 'schedule';
//$mode = 'raw';
//$mode = 'json';

try
{
    $id = "e408092a8b7f08ee3727b0b4c7f76dd7"; // test
    $d  = $cascade->getAsset( a\Destination::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $d->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $d->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "Web URL: " . $d->getWebUrl() . BR .
                "Applicable groups: " . $d->getApplicableGroups() . BR,
                "Checked by default: " . u\StringUtility::boolToString(
                    $d->getCheckedByDefault() ), BR,
                "Directory: " . $d->getDirectory(), BR,
                "Enabled: ", u\StringUtility::boolToString( $d->getEnabled() ), BR,
                "getPublishASCII: ", u\StringUtility::boolToString(
                    $d->getPublishASCII() ), BR,
                "Transport id: ", $d->getTransportId(), BR,
                "Transport path: ", $d->getTransportPath(), BR;
                
            $g = $cascade->getAsset( a\Group::TYPE, "Administrators" );
            $d->addGroup( $g )->edit();
            echo $d->getApplicableGroups() . BR;
                
            if( $mode != 'all' )
                break;
             
        case 'set':
            $d->disable()->edit();
            $d->dump();
        /*
            $g = a\Asset::getAsset( $service, a\Group::TYPE, 'chanw' );
            //$d->addGroup( $g )->edit();
            if( $d->hasGroup( $g ) )
                $d->removeGroup( $g )->edit();
  
            //$t = a\Asset::getAsset( 
                //$service, a\FtpTransport::TYPE, 
                //'4b4a41728b7f085600ae2282e04e835d' );
            //$t = a\Asset::getAsset( 
                //$service, a\FileSystemTransport::TYPE,
                //'4b68dde38b7f085600ae22829258cd7c' );
            $t = a\Asset::getAsset( 
                $service, a\DatabaseTransport::TYPE,
                '4f822a808b7f085600ae22828699d857' );
 /*/           
            $d->setWebUrl( 'http://web.upstate.edu/test' )->
                setDirectory( 'test' )->
                setCheckedByDefault( false )->
                setEnabled( true )->
                setPublishASCII( true )->
                //setTransport( $t )->
                edit()->dump();
           
            if( $mode != 'all' )
                break;

        case 'schedule':
            
            //echo u\StringUtility::getCoalescedString( $d->getSendReportToGroups() ), BR;
/*/    
            $d->addGroupToSendReport(
                    $cascade->getAsset( a\Group::TYPE, 'gch' ) )->
                addUserToSendReport( 
                    $cascade->getAsset( a\User::TYPE, 'chanw' ) )->
                //unsetScheduledPublishing()->
                edit();
 /*/                  
            // case 1: remove schedule
            //$d->unsetScheduledPublishing()->edit();
            //$d->setScheduledPublishing( false )->edit();
            // case 2: exception thrown, additional value is required
            //$d->setScheduledPublishing( true )->edit();
            // case 3a: every Friday at 12 am
            //$d->setScheduledPublishing( true, a\PublishSet::FRIDAY )->edit()->dump();
            // case 3b: every Monday at 6:30 pm
            //$d->setDayOfWeek( a\PublishSet::MONDAY, '18:30:00.000' )->edit();
            // case 3c: every Tuesday at 3 am
            /*/
            $d->setScheduledPublishing( 
                true, a\PublishSet::TUESDAY, NULL, NULL, '03:00:00.000' )->edit();
            /*/
            // case 4a: every Tuesday and Thursday at 6:30 am
            /*/
            $d->setScheduledPublishing( true, 
                array( a\PublishSet::TUESDAY, a\PublishSet::THURSDAY ), 
                NULL, NULL, '06:30:00.000' )->edit();
            /*/
            // case 4b: every Friday and Sunday at 1:00 am
            /*
            $d->setDayOfWeek( 
                array( a\PublishSet::FRIDAY, a\PublishSet::SUNDAY ),
                '01:00:00.000' )->edit();
            */
            // case 5a: everyday at 6:30 am, 
            // intentionally having repeated weekdays and random order
            /*/
            $d->setScheduledPublishing( true, 
                array( a\PublishSet::FRIDAY, a\PublishSet::FRIDAY, 
                    a\PublishSet::THURSDAY, a\PublishSet::SATURDAY, 
                    a\PublishSet::SUNDAY, a\PublishSet::WEDNESDAY,
                    a\PublishSet::TUESDAY, a\PublishSet::THURSDAY, 
                    a\PublishSet::MONDAY, a\PublishSet::SUNDAY ), 
                NULL, NULL, '06:30:00.000' )->edit();
            /*/
            // case 5b: everyday at 12 am
            //$d->setDayOfWeek( $d->getDaysOfWeek() )->edit();
            // case 6a: every 2 hours starting at 6:15 am
            /*/
            $d->setScheduledPublishing( 
                true, NULL, 2, NULL, '06:15:00.000' )->edit();
            /*/
            // case 6b: every 4 hours
            $d->setPublishIntervalHours( 4 )->edit();
            // case 7a: cron expression
            /*/
            $d->setScheduledPublishing( 
                true, NULL, NULL, "0 0 12 * * ?" )->edit();
            /*/
            // case 7b: cron expression
            //$d->setCronExpression( "0 4 12 * * ?" )->edit();
            
            echo u\StringUtility::getCoalescedString( $d->getCronExpression() ), BR;
            u\DebugUtility::dump( $d->getDaysOfWeek() );
            u\DebugUtility::dump( $d->getPublishDaysOfWeek() );
            echo u\StringUtility::getCoalescedString( $d->getPublishIntervalHours() ), BR;
            echo u\StringUtility::getCoalescedString( $d->getScheduledDestinationMode() ), BR;
            echo u\StringUtility::getCoalescedString( $d->getTimeToPublish() ), BR;
            
            $d->setSendReportOnErrorOnly( false )->edit();
            echo u\StringUtility::boolToString( $d->getSendReportOnErrorOnly() ), BR;
            echo u\StringUtility::boolToString( $d->getSendReportToGroups() ), BR;
            echo u\StringUtility::boolToString( $d->getSendReportToUsers() ), BR;
            echo u\StringUtility::boolToString( $d->getUsesScheduledPublishing() ), BR;
            /*//*/
                
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $d = $service->retrieve( $service->createId( 
                c\T::DESTINATION, $id ), c\P::DESTINATION );
            echo S_PRE;
            var_dump( $d );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
                
        case 'json':
            $std = $d->getProperty();
            u\DebugUtility::dump( $std );
            
            $array = get_object_vars( $std );
            u\DebugUtility::dump( $array );
            
            foreach( $array as $key => $value )
            {
                if( is_null( $value ) )
                {
                    unset( $array[ $key ] );
                }
            }

            u\DebugUtility::dump( json_encode( $array ) );
        
            if( $mode != 'all' )
                break;
    }
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
