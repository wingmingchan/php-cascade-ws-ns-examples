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
        a\DataDefinitionBlock::TYPE, "a4a1a0068b7f0856011c5ec6fc26bfa8" );

    echo $dd_block->getNumberOfSiblings( "multiple-second;0" ), BR;

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>