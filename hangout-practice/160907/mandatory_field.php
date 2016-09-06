<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page  = $cascade->getAsset( a\Page::TYPE, "824b63c68b7ffe830539acf09bc3135b" );

    $page_property = $page->getProperty();
    $page_property->metadata->title = "";
    $asset = new \stdClass();
    $asset->page = $page_property;
    $service->edit( $asset );
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