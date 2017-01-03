<?php 
/*
This program can be used to count pages in the entire Cascade instance.
*/
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;
use cascade_ws_AOHS      as aohs;

$start_time = time();

// Warning: this program can take a very long time to run!!!
// My run lasts for more than 6 minutes.
try
{
    u\DebugUtility::setTimeSpaceLimits();

    $site_name = 'cascade-admin';

    $sites   = $cascade->getSites();
    //$sites   = array( new p\Child( $cascade->getAsset( a\Site::TYPE, '22q' )->getIdentifier() ) );
    $results = array();
    
    foreach( $sites as $site )
    {
        $site_name = $site->getPathPath();
        
        if( u\StringUtility::endsWith( $site_name, "-dev" ) || 
            u\StringUtility::endsWith( $site_name, "-test" ) ||
            u\StringUtility::endsWith( $site_name, "-old" ) ||
            u\StringUtility::startsWith( $site_name, "_" ) ||
            u\StringUtility::startsWith( $site_name, "test" )
        )
            continue;
    
        $cascade->getAsset( 
            a\Folder::TYPE, '/', $site_name )->
            getAssetTree()->
            traverse(
                array( a\Page::TYPE => array( "assetTreeCountAsset" ) ),
                array( $site_name ),
                $results
            );
    }
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

function assetTreeCountAsset( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type      = $child->getType();
    $site_name = $params[ 0 ];
    
    if( $type != a\Page::TYPE )
        return;
        
    if( !isset( $results[ $site_name ] ) )
        $results[ $site_name ] = 0;
        
    if( !isset( $results[ "total" ] ) )
        $results[ "total" ] = 0;
    
    $results[ "total" ] = $results[ "total" ] + 1;
    $results[ $site_name ] = $results[ $site_name ] + 1;
}
?>