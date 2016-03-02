<?php 
require_once('cascade_ws_ns/auth_wing.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $block = $cascade->getAsset( a\DataBlock::TYPE, "e10da00f8b7f0856005cdf95fc73eeca" );
    
    $block->setPage( 
        "group;page-chooser",
        $cascade->getAsset( a\Page::TYPE, "87e6d0cf8b7f0856002a5e11c8e6bd21" ) )->edit();
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>