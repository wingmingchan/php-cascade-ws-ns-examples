<?php
/*
This program shows how to use an asset tree to search for a pattern in pages
and replace it with a textual value.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    // replace web.upstate.edu with www.upstate.edu
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

function assetTreeReplaceTextByPattern( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
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
    
    $asset = $child->getAsset( $service );
    
    if( count( $asset->searchTextByPattern( $pattern ) ) > 0 )
    {
        echo $child->getPathPath(), BR;
        // apply to all text nodes
        $asset->replaceByPattern( $pattern, $replacement )->edit();
    }
}
?>