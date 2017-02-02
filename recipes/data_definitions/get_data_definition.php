<?php
/*
This program shows how to retrieve the data definition object through
a StructuredData object out of a page.
Note that the data definition can be retrieved directly from the Page object.
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
    $page = $cascade->getAsset( a\Page::TYPE, "54763ffe8b7ffe83552dce4f30290433" );
    $sd   = $page->getStructuredData();
    $dd   = $sd->getDataDefinition()->dump();
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