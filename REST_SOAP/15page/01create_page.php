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
    $page_name = "index";
    
    $page = $cascade->getPage( "$page_name", $site_name );
    
    if( isset( $page ) )
    {
        $cascade->deleteAsset( $page );
    }
    
    $page = $cascade->createPage(
        $cascade->getAsset( a\Folder::TYPE, "/", $site_name ),
        $page_name,
        $cascade->getAsset(
            a\ContentType::TYPE, "Test CT Container/Page", $site_name )
    );
    
    u\DebugUtility::dump( $page->getIdentifiers() );
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
?>