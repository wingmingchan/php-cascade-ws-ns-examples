<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
    $page->setRegionBlock(
        "RWD",                 // config name
        "PAGE LEVEL OVERRIDE", // region name
        $cascade->getAsset( a\TextBlock::TYPE, '1368bba28b7f08ee1890c1e497d5ae69' )
    )->edit();
    
    // display the page-level block/format information
    u\DebugUtility::dump( $page->getPageLevelRegionBlockFormat() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>