<?php
/*
This program shows how to get a new and empty structured data out of
a data definition.
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
    $dd        = $page->getDataDefinition();
    
    // stdClass object, used with new StructuredData( $new_sd_stdClass )
    // this is an empty container
    $new_sd_stdClass = $dd->getStructuredData();
    u\DebugUtility::dump( $new_sd_stdClass );
    
    // StructuredData object, use this to map data and setStructuredData
    // the same empty container
    $new_sd = $dd->getStructuredDataObject();
    u\DebugUtility::dump( $new_sd->toStdClass() );
    
    // StructuredData object of the page, containing data
    u\DebugUtility::dump( $page->getStructuredData()->toStdClass() );
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