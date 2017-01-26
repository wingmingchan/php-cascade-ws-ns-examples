<?php
/*
This program shows how to retrieve the textual value from a wired field.
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
    // page to be moved
    $page   = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
    
    // folder to which the page should be moved
    $folder = $cascade->getAsset( a\Folder::TYPE, 'fff3a7538b7f08ee3e513744ae475537' );
    
    $page->move( $folder, false ); // false for no workflow
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