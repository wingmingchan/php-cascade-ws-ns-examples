<?php
/* 
This program shows how dangerous web services can be.
A text block can be turned into a feed block easily.
If we don't encapsulate the properties of assets, we can do really crazy things.
For example, we can turn a block into a page.
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
    $feed_block       = $cascade->getAsset(
        a\FeedBlock::TYPE, "388f3c9e8b7ffe83164c9314b41331a3" );
    $feed_p           = $feed_block->getProperty();
    
    $text_block       = $cascade->getAsset(
        a\TextBlock::TYPE, "388f8a9a8b7ffe83164c931452497db5" );
    $text_p           = $text_block->getProperty();
        
    $text_block_id    = "388f033b8b7ffe83164c9314c23a3f8f";
    $text_p           = $feed_p;
    //$text_p           = $text_p;
    $text_p->id       = $text_block_id;

    $asset            = new \stdClass();
    $asset->feedBlock = $feed_p;
    //$asset->textBlock = $text_p;
    $service->edit( $asset );
    
    if( $service->isSuccessful() )
        echo "Success";
    else
        echo $service->getMessage();
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