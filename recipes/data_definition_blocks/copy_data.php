<?php
/*
This program shows how to copy the data definition as well as data
from one block to another block.
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
    $source_block = $cascade->getAsset( 
        a\DataDefinitionBlock::TYPE, "a4a1a0068b7f0856011c5ec6fc26bfa8" );
    $target_block = $cascade->getAsset( 
        a\DataDefinitionBlock::TYPE, "07ff55e98b7f08ee601529410c10bcaa" );
        
    $source_block->copyDataTo( $target_block );  
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