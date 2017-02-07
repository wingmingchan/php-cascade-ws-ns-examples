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
    echo u\StringUtility::boolToString(
        $cascade->getAsset(
            a\Page::TYPE, "1e64191a8b7f08ee4bf6727368416cbe" )->hasPhantomNodes() );
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