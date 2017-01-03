<?php
/*
This program is used to count assets of various types.
*/
$start_time = time();

require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_AOHS      as aohs;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
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

    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>