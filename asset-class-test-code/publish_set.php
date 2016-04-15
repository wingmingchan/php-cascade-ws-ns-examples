<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
//$mode = 'get';
//$mode = 'add';
//$mode = 'remove';
//$mode = 'set';
//$mode = 'publish';
//$mode = 'raw';

try
{
    $id = "0c7b923a8b7f08560139425cfd6e20b0"; // Test Publish Set
    $ps = $cascade->getAsset( a\PublishSet::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $ps->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ps->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $ps->getId() . BR;
            
            echo BR . S_PRE;
            var_dump( $ps->getFilePaths() );
            echo E_PRE;
            
            echo BR . S_PRE;
            var_dump( $ps->getFolderPaths() );
            echo E_PRE;
            
            echo BR . S_PRE;
            var_dump( $ps->getPagePaths() );
            echo E_PRE;            

            if( $mode != 'all' )
                break;
             
        case 'add':
            // reference
            $ps->addPage( a\Asset::getAsset( 
                $service, a\Page::TYPE,
                '08d27c2a8b7f08560139425c13e5ce17' ) )->
            // test.css
                 addFile( a\Asset::getAsset( 
                     $service, a\File::TYPE,
                     '05ce824d8b7f08560139425c9aba7f6d' ) )->
            // test-folder
                 addFolder( a\Asset::getAsset( 
                     $service, a\Folder::TYPE,
                     'b8bf838f8b7f0856002a5e11586fba90' ) )->
            // test-folder2
                 addFolder( a\Asset::getAsset( 
                     $service, a\Folder::TYPE,
                     'df9aa6628b7f085600adcd8159dd733a' ) )->
                 edit();

            if( $mode != 'all' )
                break;

        case 'remove':
            // test.css
            $ps->removeFile( a\Asset::getAsset( 
                $service, a\File::TYPE,
                '05ce824d8b7f08560139425c9aba7f6d' ) )->
            // test-folder2
                 removeFolder( a\Asset::getAsset( 
                     $service, a\Folder::TYPE,
                     'df9aa6628b7f085600adcd8159dd733a' ) )->
                 edit();
            
            if( $mode != 'all' )
                break;

        case 'set':
            // case 1: remove schedule
            //$ps->unsetScheduledPublishing()->edit();
            //$ps->setScheduledPublishing( false )->edit();
            // case 2: exception thrown, additional value is required
            //$ps->setScheduledPublishing( true )->edit();
            // case 3a: every Friday at 12 am
            //$ps->setScheduledPublishing( true, a\PublishSet::FRIDAY )->edit();
            // case 3b: every Monday at 6:30 pm
            //$ps->setDayOfWeek( a\PublishSet::MONDAY, '18:30:00.000' )->edit();
            // case 3c: every Tuesday at 3 am
            /*
            $ps->setScheduledPublishing( 
                true, a\PublishSet::TUESDAY, NULL, NULL, '03:00:00.000' )->edit();
            */
            // case 4a: every Tuesday and Thursday at 6:30 am
            /*
            $ps->setScheduledPublishing( true, 
                array( a\PublishSet::TUESDAY, a\PublishSet::THURSDAY ), 
                NULL, NULL, '06:30:00.000' )->edit();
            */
            // case 4b: every Friday and Sunday at 1:00 am
            /*
            $ps->setDayOfWeek( 
                array( a\PublishSet::FRIDAY, a\PublishSet::SUNDAY ),
                '01:00:00.000' )->edit();
            */
            // case 5a: everyday at 6:30 am, 
            // intentionally having repeated weekdays and random order
            /*
            $ps->setScheduledPublishing( true, 
                array( a\PublishSet::FRIDAY, a\PublishSet::FRIDAY, 
                    a\PublishSet::THURSDAY, a\PublishSet::SATURDAY, 
                    a\PublishSet::SUNDAY, a\PublishSet::WEDNESDAY,
                    a\PublishSet::TUESDAY, a\PublishSet::THURSDAY, 
                    a\PublishSet::MONDAY, a\PublishSet::SUNDAY ), 
                NULL, NULL, '06:30:00.000' )->edit();
            */
            // case 5b: everyday at 12 am
            //$ps->setDayOfWeek( $ps->getDaysOfWeek() )->edit();
            // case 6a: every 2 hours starting at 6:15 am
            /*
            $ps->setScheduledPublishing( 
                true, NULL, 2, NULL, '06:15:00.000' )->edit();
            */
            // case 6b: every 4 hours
            //$ps->setPublishIntervalHours( 4 )->edit();
            // case 7a: cron expression
            /*
            $ps->setScheduledPublishing( 
                true, NULL, NULL, "0 0 12 * * ?" )->edit();
            */
            // case 7b: cron expression
            $ps->setCronExpression( "0 4 12 * * ?" )->edit();
                
            if( $mode != 'all' )
                break;

        case 'publish':
            $ps->publish();

            if( $mode != 'all' )
                break;

        case 'raw':
            $ps_std = $service->retrieve( $service->createId( 
                c\T::PUBLISHSET, $id ), c\P::PUBLISHSET );
               
            //$ps_std->usesScheduledPublishing = true;
            //$ps_std->timeToPublish = "00:00:00.000";
            unset($ps_std->publishIntervalHours);
            unset($ps_std->cronExpression);
            
            //$day = new stdClass();
            //$day->dayOfWeek = "Friday";
            //$ps_std->publishDaysOfWeek = $day;

            //echo S_PRE;
            //var_dump( $ps_std );
            //echo E_PRE;
            
            //echo $ps_std->timeToPublish . BR;
          
            $asset = new \stdClass();
            $asset->publishSet = $ps_std;
            $service->edit( $asset );
            
            if( $service->isSuccessful() )
            {
                echo "Edited successfully." . BR;
            }
            else
            {
                echo "Failed to edit." . BR;
                echo $service->getMessage();
            }

            $ps_std = $service->retrieve( $service->createId( 
                c\T::PUBLISHSET, $id ), c\P::PUBLISHSET );
            
            echo S_PRE;
            u\DebugUtility::dump( $ps_std );
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
