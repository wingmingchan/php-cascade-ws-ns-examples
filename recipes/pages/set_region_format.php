<?php 
/*
This program shows how to attach a format to a region.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
    $page->setRegionFormat(
        "RWD",                 // config name
        "BANNER FULL WIDTH",   // region name
        $cascade->getAsset( a\XsltFormat::TYPE, '5a654ee68b7f0856001b890211c4f553' )
    )->edit();
    
    // display the page-level block/format information
    u\DebugUtility::dump( $page->getPageLevelRegionBlockFormat() );
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