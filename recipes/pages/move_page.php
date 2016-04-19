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
    // page to be moved
    $page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );
    
    // folder to which the page should be moved
    $folder = $cascade->getAsset( a\Folder::TYPE, '8b5193ee8b7f08ee26d2e6f290705401' );
    
    $page->move( $folder, false ); // false for no workflow
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>