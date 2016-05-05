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
    $dd = $cascade->getAsset( 
        a\DataDefinition::TYPE, "5f4526bb8b7f08ee76b12c417a2b982b" );
        
    u\DebugUtility::dump( $dd->getIdentifiers() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>