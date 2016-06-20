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
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );
    
    $pattern     = "/<(a[^>]+href=['\"]\S+)web(\.upstate\.edu)/";
    $replacement = '<${1}www${2}';

    $params  = array( 
        "pattern"     => $pattern,
        "replacement" => $replacement
    );
    
    $cascade->getAsset( a\Folder::TYPE, "5fa0f00d8b7f0856002a5e11033c2ad1" )->
        getAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreeReplaceTextByPattern" ) ),
            $params
        );

    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}

function assetTreeReplaceTextByPattern( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type      = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataBlock::TYPE )
    {
        return;
    }
    
    $pattern     = $params[ "pattern" ];
    $replacement = $params[ "replacement" ];
    
    if( !isset( $pattern ) || trim( $pattern ) == "" )
    {
        throw new \Exception( "No pattern is supplied" );
    }
    
    if( !isset( $replacement ) || trim( $replacement ) == "" )
    {
        throw new \Exception( "No replacement is supplied" );
    }
    
    $page = $child->getAsset( $service );
    
    if( count( $page->searchTextByPattern( $pattern ) ) > 0 )
    {
    	echo $child->getPathPath(), BR;
    	$page->replaceByPattern( $pattern, $replacement )->edit();
    }
}
?>