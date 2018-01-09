<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "about-test";
    $msc_name  = "Test MS Container";
    $ms_name   = "Page";
    
    $ms = $cascade->getMetadataSet( "$msc_name/$ms_name", $site_name );
    
    if( isset( $ms ) )
    {
        $cascade->deleteAsset( $ms );
    }
    
    $ms = $cascade->createMetadataSet(
        $cascade->getAsset( a\MetadataSetContainer::TYPE, $msc_name, $site_name ),
        $ms_name
    )->dump();
    
    u\DebugUtility::dumpRESTCommands( $service );    
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
/*

    u\DebugUtility::dump( $page );
    echo u\StringUtility::getCoalescedString( $m->getEndDate() ), BR;

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump();
*/
?>