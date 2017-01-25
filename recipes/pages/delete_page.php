<?php 
/*
This program shows how to delete a page.
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
    // there is no point in loading the page to delete it
    // just pass in the ID
    $cascade->deletePage( "d5f5eb358b7f08ee18c89a8f3914a4e9" );
    // or path/site name
    $cascade->deletePage( "test/new-page1", "cascade-admin-old" );
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