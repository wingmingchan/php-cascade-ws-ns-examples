<?php
/*
This program shows how to loop through all nodes of the same node set
and possibly do something to every instance.
*/
require_once('auth_chanw.php');

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
    $num_siblings = $dd_block->getNumberOfSiblings( "multiple-second;0" );
    
    for( $i = 0; $i < $num_siblings; $i++ )
    {
        echo $dd_block->getText( "multiple-second;" . $i ) . BR;
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