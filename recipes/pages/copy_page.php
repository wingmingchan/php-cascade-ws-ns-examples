<?php 
/*
This program shows how to create a copy of an existing page
and place the copy in a folder.
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
    // the page to be copied
    $master_page = $cascade->getAsset( a\Page::TYPE, 'c7ffdcbd8b7f0856018587ac424c60a7' );
    
    // the folder in which the new page should be placed
    $folder = $cascade->getAsset( a\Folder::TYPE, 'ffe39a278b7f08ee3e513744c5d70ead' );
    
    // copy page
    $master_page->copy( $folder, "new-page" );
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