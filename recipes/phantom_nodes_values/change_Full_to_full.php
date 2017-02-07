<?php
/*
This program is used to fix a phantom value.
Since we are fixing the data, fully qulified identifiers are required to change the data.
*/
$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    $folder_id = "8df13e888b7f085600ebf23eff9aca6d";
    
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreeChangeFull" ) )
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

function assetTreeChangeFull( 
    aohs\AssetOperationHandlerService $service, p\Child $child, 
    array $params=NULL, array &$results=NULL )
{
    // skip entire folder
    if( strpos( $child->getPathPath(), "_extra/" ) !== false )
        return;
        
    if( strpos( $child->getPathPath(), "_cascade/" ) !== false )
        return;

    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    $page = $child->getAsset( $service );
    
    try
    {
        if( $page->hasStructuredData() )
        {
            $node_ids = array( 
                "size", 
                "content-group;0;content-group-size", 
                "content-group;1;content-group-size",
                "content-group;2;content-group-size",
                "content-group;3;content-group-size" );
                
            foreach( $node_ids as $node_id )
            {
                if( $page->hasNode( $node_id ) && ( 
                    $page->getText( $node_id ) == "Full" || 
                    $page->getText( $node_id ) == "" || 
                    $page->getText( $node_id ) == NULL )
                )
                    $page->setText( $node_id, "full" )->edit();
            }
        }
    }
    catch( \Exception $e )
    {
        echo $page->getId(), BR;
        throw $e;
    }
}
?>