<?php
/*
When a phantom node is encountered, normally the execution of a program will terminate
with a message, saying that a certain field does not exist. The message only gives
the initial part of the id string of the block. To be able to locate the block, we need
to have the complete id string. Use this program to find the id of that block.
The program can be modified to find a page instead.
*/
require_once( 'cascade_ws_ns/auth_chanw.php' );
require_once( '/webfs/www/nosync/cascade/admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;


try
{
	$initial_id  = "199cfb3f8b7f08e";
	$site_name   = "accelerator";
	$cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolderAssetTree()->
		traverse( 
			array( a\DataBlock::TYPE  => array( "assetTreeFindDDBlockWithIntialId" ) ),
			array( "partial-id" => $initial_id ) );

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}


function assetTreeFindDDBlockWithIntialId( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
	if( !isset( $params[ 'partial-id' ] ) )
		throw new \Exception( "The id is not included" );
	
	$partial_id = $params[ 'partial-id' ];
	
	$type = $child->getType();
	
	if( $type != a\DataBlock::TYPE )
		return;
		
	$id = $child->getId();
	
	if( !u\StringUtility::startsWith( $id, $partial_id ) )
	{
		return;
	}
	else
	{
		echo $id;
	}
}
?>