<?php 
require_once('cascade_ws_ns/auth_chanw.php');

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
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );

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
    
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
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