<?php
/* This program shows how to replace the data definition associated
with a data definition block. In effect, the block will have a new
data container, with no data inside. For data mapping, see
https://github.com/wingmingchan/php-cascade-ws-ns-examples/tree/master/recipes/data_mapping
*/

require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $block = $cascade->getAsset( a\DataBlock::TYPE, "d1ffa9298b7ffe837521e02210c6572f" );
    $dd    = $cascade->getAsset(
        a\DataDefinition::TYPE, "1f2408778b7ffe834c5fe91ec3aefb48" );
    $sd    = $dd->getStructuredDataObject();
    $block->setStructuredData( $sd );
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