<?php
/*
No longer breaks the block in Cascade 8.
*/
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    //  /_cascade/blocks/data/test-all
    $block = $cascade->getAsset( a\DataBlock::TYPE, "388f47b28b7ffe83164c9314962df0d4" );
    $block_property = $block->getProperty();
    
    $block_property->structuredData->structuredDataNodes->structuredDataNode->
        structuredDataNodes->structuredDataNode[ 3 ]->text = "";
    $asset = new \stdClass();
    $asset->xhtmlDataDefinitionBlock = $block_property;
    $service->edit( $asset );
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