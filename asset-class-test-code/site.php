<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

//require_once('cascade_ws/auth_sandbox.php');

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'schedule';
//$mode = 'assignment';
//$mode = 'set';
//$mode = 'publish';
//$mode = 'asset-tree';
//$mode = 'raw';

try
{
    $id = "tuw-test"; // tuw-test
    //$id = "cascade-admin"; // on sandbox
    $s  = $cascade->getAsset( a\Site::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $s->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $s->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            // test ScheduledPublishing
            echo "Cron expression: " . $s->getCronExpression() . BR .
                "Days of week: " . $s->getDaysOfWeek() . BR .
                "Publish days of week: " . BR;
            var_dump( $s->getPublishDaysOfWeek() );
            echo BR .
                "Publish interval hours: " . 
                $s->getPublishIntervalHours() . BR .
                "Send report on error only: " . 
                $s->getSendReportOnErrorOnly() . BR .
                "Send report to groups: " . 
                $s->getSendReportToGroups() . BR .
                "Send report to users: " . 
                $s->getSendReportToUsers() . BR .
                "Time to publish: " . 
                $s->getTimeToPublish() . BR;
                
            // test Site
            echo 
                "Site name: " . $s->getSiteName() . BR .
                "Default metadata set ID: " . 
                $s->getDefaultMetadataSetId() . BR .
                
                "";
            if( $mode != 'all' )
                break;
                
        case 'schedule':
            // case 1: remove schedule
            //$s->unsetScheduledPublishing()->edit();
            //$s->setScheduledPublishing( false )->edit();
            // case 2: exception thrown, additional value is required
            //$s->setScheduledPublishing( true )->edit();
            // case 3a: every Friday at 12 am
            //$s->setScheduledPublishing( true, a\PublishSet::FRIDAY )->edit();
            // case 3b: every Monday at 6:30 pm
            //$s->setDayOfWeek( a\PublishSet::MONDAY, '18:30:00.000' )->edit();
            // case 3c: every Tuesday at 3 am
            /*
            $s->setScheduledPublishing( 
                true, a\PublishSet::TUESDAY, NULL, NULL, '03:00:00.000' )->edit();
            */
            // case 4a: every Tuesday and Thursday at 6:30 am
            /*
            $s->setScheduledPublishing( true, 
                array( a\PublishSet::TUESDAY, a\PublishSet::THURSDAY ), 
                NULL, NULL, '06:30:00.000' )->edit();
            */
            // case 4b: every Friday and Sunday at 1:00 am
            /*
            $s->setDayOfWeek( 
                array( a\PublishSet::FRIDAY, a\PublishSet::SUNDAY ),
                '01:00:00.000' )->edit();
            */
            // case 5a: everyday at 6:30 am, 
            // intentionally having repeated weekdays and random order
            /*
            $s->setScheduledPublishing( true, 
                array( a\PublishSet::FRIDAY, a\PublishSet::FRIDAY, 
                    a\PublishSet::THURSDAY, a\PublishSet::SATURDAY, 
                    a\PublishSet::SUNDAY, a\PublishSet::WEDNESDAY,
                    a\PublishSet::TUESDAY, a\PublishSet::THURSDAY, 
                    a\PublishSet::MONDAY, a\PublishSet::SUNDAY ), 
                //NULL, NULL, '06:30:00.000' )->edit();
                NULL, NULL, '01:00:00.000' )->edit();
            */
            // case 5b: everyday at 12 am
            //$s->setDayOfWeek( $s->getDaysOfWeek(), '01:00:00.000' )->edit();
            // case 6a: every 2 hours starting at 6:15 am
            /*
            $s->setScheduledPublishing( 
                true, NULL, 2, NULL, '06:15:00.000' )->edit();
            */
            // case 6b: every 4 hours
            //$s->setPublishIntervalHours( 4 )->edit();
            // case 7a: cron expression
            $s->setScheduledPublishing( 
                true, NULL, NULL, "0 0 12 * * ?" )->edit();
            
            // case 7b: cron expression
            //$s->setCronExpression( "0 4 12 * * ?" )->edit();
                
            if( $mode != 'all' )
                break;
            
        case 'assignment':
            $r = $cascade->getAsset( a\Role::TYPE, 50 ); // site publisher
            $s->addRole( $r )->edit();
        
            $s->addUserToRole( 
                $r, $cascade->getAsset( a\User::TYPE, 'chanw' ) )->
                addUserToRole( 
                    $r, $cascade->getAsset( a\User::TYPE, 'tuw' ) )->
                addGroupToRole( 
                    $r, $cascade->getAsset( a\Group::TYPE, 'cru' ) )->
                edit();
        
            //$s->removeRole( $r )->edit();
                
            if( $mode != 'all' )
                break;
                
        case 'set':
            $s->
                // URL
                setUrl( 'http://www.upstate.edu/tuw-test' )->
                // metadata set
                setDefaultMetadataSet( 
                    a\Asset::getAsset( $service, a\MetadataSet::TYPE,
                        'b893fd058b7f0856002a5e11185ff809' ) )->
                // css
                setCssFile(
                /*
                    a\Asset::getAsset( $service, a\File::TYPE, 
                        '4007ae9d8b7f08560139425c99384b99' ), 
                        'leftobject,rightobject,center,centerobject'
                */
                    NULL
                )->
                // asset factory container
                setSiteAssetFactoryContainer( 
                    a\Asset::getAsset( 
                        $service, a\AssetFactoryContainer::TYPE,
                        '04af3e2e8b7f085600e28886d7e2221d' )
                    // NULL
                )->
                // starting page
                setStartingPage( 
                    a\Asset::getAsset( 
                        $service, a\Page::TYPE, 
                        '04af1d7a8b7f085600e28886865346c3' )
                    //NULL
                )->
                // send report on error
                setSendReportOnErrorOnly( true )->
                // add user to send report
                addUserToSendReport( a\Asset::getAsset( 
                    $service, a\User::TYPE, 'tuw' ) )->
                // add group to send report
                addGroupToSendReport( a\Asset::getAsset( 
                    $service, a\Group::TYPE, 'hemonc' ) )->
                // expiration
                setRecycleBinExpiration( a\Site::NEVER )->
                edit();
                
            if( $mode != 'all' )
                break;
                
        case 'publish':
            //$s->publish();
                
            if( $mode != 'all' )
                break;
        
        case 'asset-tree':
            echo S_PRE . u\XMLUtility::replaceBrackets( 
                $s->getRootAssetFactoryContainerAssetTree()->
                toXml() ) . E_PRE;
                
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $s_std = $service->retrieve( $service->createId( 
                c\T::SITE, $id ), c\P::SITE );
/*          
            if( $s_std->timeToPublish == NULL )
                unset( $s_std->timeToPublish );
            else if( strpos( $s_std->timeToPublish, '-' ) !== false )
            {
                $pos = strpos( $s_std->timeToPublish, '-' );
                $s_std->timeToPublish = substr( $s_std->timeToPublish, 0, $pos );
            }
            
            if( $s_std->publishIntervalHours == NULL )
                unset( $s_std->publishIntervalHours );
                
            if( $s_std->publishDaysOfWeek == NULL )
                unset( $s_std->publishDaysOfWeek );
          
            $asset->site = $s_std;
            $service->edit( $asset );
            
            if( !$service->isSuccessful() )
            {
                echo "Failed to edit." . $service->getMessage() . BR;
            }
*/ 

            echo S_PRE;
            var_dump( $s_std );
            echo E_PRE;

            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
