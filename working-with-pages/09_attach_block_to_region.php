<?php
/*
This program attaches a block to a region of a page.
Invoke setRegionFormat to attach a format to a region.
*/

require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page  = $admin->getAsset( a\Page::TYPE, "681da2ca7f00000161e16fb03983fb1d" );
    $block = $admin->getAsset( a\XmlBlock::TYPE, "6ca0f95e7f00000161e16fb069f361fd" );
    
    $page->setRegionBlock( "RWD", "DEFAULT", $block )->edit();
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