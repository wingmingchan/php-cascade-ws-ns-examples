<?php
/*
This program can take a very long time to run.
*/
$start_time = time();

require_once( 'cascade_ws_ns/auth_chanw.php' );

// to prevent time-out
set_time_limit( 10000 );
// to prevent using up memory when traversing a large site
ini_set( 'memory_limit', '2048M' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

// site/folder to be traverse
$folder_id = "1e640d568b7f08ee4bf672732f23b0d5";

try
{
    //$cascade->getSite( $site_name )->getBaseFolderAssetTree()->
    $cascade->getAsset( a\Folder::TYPE, $folder_id )->getAssetTree()->
        traverse(
            array( a\Page::TYPE =>      array( "assetTreeFixPhantomNodes" ),
                   a\DataBlock::TYPE => array( "assetTreeFixPhantomNodes" ) )
        );
    
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}


function assetTreeFixPhantomNodes( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataBlock::TYPE )
        return;
    
    try
    {
        $asset = $child->getAsset( $service );
        
        if( $asset->hasPhantomNodes() ) // type B
        {
        	$asset->mapData();
        }
    }
    catch( e\NoSuchFieldException $e ) // type A
    {
    	if( $type == a\Page::TYPE )
    	{
    		$asset = new a\PagePhantom( $service, $child->toStdClass() );
    	}
    	else
    	{
    		$asset = new a\DataDefinitionBlockPhantom( $service, $child->toStdClass() );
    	}
    	
    	$dd         = $asset->getDataDefinition();
		$healthy_sd = new p\StructuredData( $dd->getStructuredData(), $service, $dd->getId() );
		$phantom_sd = $phantom_page->getStructuredDataPhantom();
		$healthy_sd = $healthy_sd->removePhantomNodes( $phantom_sd );

		$asset->setStructuredData( $healthy_sd );
    }
}
?>