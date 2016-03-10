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
    $cascade->getAsset( a\Page::TYPE, "1e64191a8b7f08ee4bf6727368416cbe" )->hasPhantomNodes();
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>