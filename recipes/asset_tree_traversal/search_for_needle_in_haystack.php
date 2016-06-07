<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    $folder_id = 'fd279b248b7f08560159f3f0614d475b';
    $results   = array();
    
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse(
            array( a\XsltFormat::TYPE => array( 'assetTreeSearchForNeedleInHaystack' ) ),
            array( a\XsltFormat::TYPE => array(
                // the string to search for (the needle)
                'needle' => 'bricks:process',
                // the method to call to get the string to be searched (the haystack)
                'method' => 'getXml' )
            ),
            $results
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

function assetTreeSearchForNeedleInHaystack( 
    aohs\AssetOperationHandlerService 
    $service, p\Child $child, $params=NULL, &$results=NULL )
{
    $type     = $child->getType();
    $needle   = $params[ $type ][ 'needle' ];
    // the method name should be defined for the asset
    // and returns a string
    $method   = $params[ $type ][ 'method' ];
    $haystack = $child->getAsset( $service )->$method();
    
    if( strpos( $haystack, $needle ) !== false )
    {
        $results[ $type ][] = $child->getPathPath();
    }
}
?>