<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $path = "_cascade/blocks/data/audio-player";
    $service->read( 
        $service->createId( a\DataBlock::TYPE, $path, "cascade-admin" ) );
    
    if($service->isSuccessful())
    {
        echo "Read successfully<br />";
        
        $block = $service->getReadAsset()->xhtmlDataDefinitionBlock;
        
        u\DebugUtility::dump( $block );
            
        if( $block->structuredData->
            structuredDataNodes->
            structuredDataNode[2]->
            structuredDataNodes->
            structuredDataNode[0]->text == 'Example Audio Player' )
        {
            // edit the text
            $block->structuredData->
                structuredDataNodes->
                structuredDataNode[2]->
                structuredDataNodes->
                structuredDataNode[0]->text = 'Audio Player';
            
            $asset = new \stdClass();
            $asset->xhtmlDataDefinitionBlock = $block;
            
            $service->edit( $asset );
            
            if($service->isSuccessful())
            {
                echo "Edited block successfully<br />";
            }
            else
            {
                echo "Failed to edit block<br />";
            }
        }
        else if( $block->structuredData->
            structuredDataNodes->
            structuredDataNode[2]->
            structuredDataNodes->
            structuredDataNode[0]->text == 'Audio Player' )
        {
            echo "The text has already been changed<br />";
        }
    }
    else
        echo "Failed to read. " . $service->getMessage();
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>