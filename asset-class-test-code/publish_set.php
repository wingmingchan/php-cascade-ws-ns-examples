<?php
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
$mode = 'get';
//$mode = 'add';
//$mode = 'remove';
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
            u\DebugUtility::dump( $ps->getFilePaths() );
            u\DebugUtility::dump( $ps->getFolderPaths() );
            u\DebugUtility::dump( $ps->getPagePaths() );

            if( $mode != 'all' )
                break;
             
        case 'add':
            // reference
            $ps->addPage( $cascade->getAsset(
                    a\Page::TYPE, '1f2373488b7ffe834c5fe91e2f1fb803' ) )->
            // test.css
                 addFile( $cascade->getAsset(
                     a\File::TYPE, '1f2259288b7ffe834c5fe91e55c1b66f' ) )->
            // test-folder
                 addFolder( $cascade->getAsset(
                     a\Folder::TYPE, '1f229e908b7ffe834c5fe91e04cc2303' ) )->
                 edit()->dump();

            if( $mode != 'all' )
                break;

        case 'remove':
            // test.css
            $ps->removeFile( $cascade->getAsset(
                     a\File::TYPE, '1f2259288b7ffe834c5fe91e55c1b66f' ) )->
            // test-folder2
                 removeFolder( $cascade->getAsset(
                     a\Folder::TYPE, '1f229e908b7ffe834c5fe91e04cc2303' ) )->
                 edit()->dump();
            
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
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\PublishSet" );
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