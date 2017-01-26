<?php
/*
This program shows how to get the structured data object from a page.
This is the starting point of data mapping.
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
    $site_name = "cascade-admin-old";
    $page_name = "test/new-page";
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    $sd   = $page->getStructuredData();
    
    u\DebugUtility::dump( $sd->toStdClass() );
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