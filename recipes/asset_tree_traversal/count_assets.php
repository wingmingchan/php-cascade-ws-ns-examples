<?php
/*
This program is used to count assets of various types.
*/
$start_time = time();

require_once('cascade_ws_ns/auth_wing.php');

use cascade_ws_constants as c;
use cascade_ws_AOHS as aohs;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );
    
    $site_name = 'cascade-admin';

    $results = $report->
        setRootFolder( 
            $cascade->getAsset( 
                a\Folder::TYPE, '/', $site_name )
        )->reportNumberOfAssets(
            array(
                a\DataBlock::TYPE,
                a\FeedBlock::TYPE,
                a\File::TYPE,
                a\Folder::TYPE,
                a\IndexBlock::TYPE,
                a\Page::TYPE,
                a\ScriptFormat::TYPE,
                a\Symlink::TYPE,
                a\Template::TYPE,
                a\TextBlock::TYPE,
                a\XmlBlock::TYPE,
                a\XsltFormat::TYPE
            ) 
        );

    u\DebugUtility::dump( $results );

    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
?>