<?php 
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = "page";
$mode = "block";

try
{
    switch( $mode )
    {
        case "page":
            $page_id      = "5b8f10ee8b7f08ee6e9bc35c0ee70da5";
            $phantom_page = new a\PagePhantom( $service, $service->createId( a\PagePhantom::TYPE, $page_id ) );
            $dd           = $phantom_page->getDataDefinition();
            $healthy_sd   = new p\StructuredData( $dd->getStructuredData(), $service, $dd->getId() );
            $phantom_sd   = $phantom_page->getStructuredDataPhantom();
            $healthy_sd   = $healthy_sd->removePhantomNodes( $phantom_sd );
    
            $phantom_page->setStructuredData( $healthy_sd );
            $cascade->getAsset( a\Page::TYPE, $page_id )->dump( true );

            break;
        
        case "block":
            $block_id      = "5bfdb6428b7f08ee6e9bc35c740caf9e";
            $phantom_block = new a\DataDefinitionBlockPhantom( 
                $service, $service->createId( a\DataDefinitionBlockPhantom::TYPE, $block_id ) );
            $dd            = $phantom_block->getDataDefinition();
            $healthy_sd    = new p\StructuredData( $dd->getStructuredData(), $service, $dd->getId() );
            $phantom_sd    = $phantom_block->getStructuredDataPhantom();
            $healthy_sd    = $healthy_sd->removePhantomNodes( $phantom_sd );
            
            $phantom_block->setStructuredData( $healthy_sd );
            $cascade->getAsset( a\DataBlock::TYPE, $block_id )->dump( true );

            break;
    }
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