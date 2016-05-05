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
    $dd_block = $cascade->getAsset( 
        a\DataDefinitionBlock::TYPE, "32fca8458b7f08ee384a2061ad1d5f17" );
        
    u\DebugUtility::dump( $dd_block->getIdentifiers() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>