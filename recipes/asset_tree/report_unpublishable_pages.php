<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

// Note that this program does not work for publishable pages or folders
// inside unpublishable folders. To do this, we have to traverse an entire site and
// cache all unpublishable folders.

try
{
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );
    
    $results = array();

    $cascade->getAsset( a\Folder::TYPE, 'ede7f1338b7f08560139425cf45c4cc8' )->
        getAssetTree()->traverse(
            array( a\Page::TYPE => array( "assetTreeReportUnpublishableAsset" ) ), 
            NULL,
            $results );
            
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

function assetTreeReportUnpublishableAsset(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL
)
{
    $type = $child->getType();

    if( $type != a\Folder::TYPE &&
        $type != a\Page::TYPE &&
        $type != a\File::TYPE )
        return;
        
    if( !isset( $results ) )
        throw new \Exception( "No result array is passed in" );
        
    if( !isset( $results[ $type ] ) )
    {
        $results[ $type ] = array();
    }
    
    $asset = $child->getAsset( $service );
    
    if( !$asset->isPublishable() )
        $results[ $type ][] = $asset->getPath();
}
?>