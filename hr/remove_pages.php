<?php
/*
This program is used to remove unwanted pages created by httrack.
*/

$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
    $f  = $cascade->getAsset(
        a\Folder::TYPE, '157dbeb18b7f08ee3d99a2112635dd3b' );

    // traverse the folder
    $f->getAssetTree()->traverse(
        array( a\Page::TYPE => array( 'assetTreeRemoveUnwantedPage' ) )
    );
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

function assetTreeRemoveUnwantedPage( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    if( $child->getType() != a\Page::TYPE )
        return;

    $page_path = $child->getPathPath();
    
    // junk page names
    if( u\StringUtility::endsWith( $page_path, "/pdf" ) ||
        u\StringUtility::endsWith( $page_path, "/word" ) ||
        u\StringUtility::endsWith( $page_path, "/externallink" ) ||
        u\StringUtility::endsWith( $page_path, "/keytiny" ) ||
        u\StringUtility::endsWith( $page_path, "/index-2" ) )
        $service->delete( $child->toStdClass() );
}
?>