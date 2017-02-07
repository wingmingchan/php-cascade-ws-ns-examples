<?php 
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{

    $block_id      = "5bfdb6428b7f08ee6e9bc35c740caf9e";
    
    // load the block with a phantom node
    $phantom_block = new a\DataDefinitionBlockPhantom( $service, $service->createId( a\DataDefinitionBlockPhantom::TYPE, $block_id ) );
    
    $block_property = $phantom_block->getProperty();
    $sd_array       = $block_property->structuredData->
        structuredDataNodes->structuredDataNode;
    
    // add another phantom node
    $phantom             = new \stdClass();
    $phantom->type       = "text";
    $phantom->identifier = "phantom";
    $phantom->text       = "Phantom value";
    
    if( is_array( $sd_array ) )
    	$sd_array[]      = $phantom;
    else
    	$sd_array        = $phantom;
    
    $asset = a\AssetTemplate::getDataDefinitionBlock();
    $asset->xhtmlDataDefinitionBlock = $block_property;
    $asset->xhtmlDataDefinitionBlock->structuredData->
        structuredDataNodes->structuredDataNode =
        $sd_array;
    $service->edit( $asset );
    
    // exception thrown here!
    $cascade->getAsset( a\DataBlock::TYPE, $block_id );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
catch( \Error $er ) 
{
    echo S_PRE . $er . E_PRE;
}
?>