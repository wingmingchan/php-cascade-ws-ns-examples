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
    //$cascade->getAsset( a\Page::TYPE, "51a542e68b7f085600a0fcdcd36836b4" )->dump( true );
    $cascade->getAsset( 
            a\TextBlock::TYPE, "_cascade/blocks/code/ajax-read-profile-php", "cascade-admin" )->
        dump( true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>