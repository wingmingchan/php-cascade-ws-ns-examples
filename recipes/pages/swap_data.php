<?php 
/*
This program shows how to swap two instances of a multiple group.
This technique works for any two instances of the same set of multiple nodes.
The prerequisite is that the two fully qualified identifiers involved
differ only in the last digital part, meaning the two nodes must be siblings
and both are instances of the same set.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );

    // swap the two instances of a multiple group
    $page->swapData( "content-group;0", "content-group;1" );
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