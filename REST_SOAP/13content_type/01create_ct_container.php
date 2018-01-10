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
    $ctc_name  = "Test CT Container";
    $ctc = $cascade->getContentTypeContainer( $ctc_name, $site_name );
    
    if( isset( $ctc ) )
    {
        $cascade->deleteAsset( $ctc );
    }
    
    $ctc = $cascade->createContentTypeContainer(
        $cascade->getAsset( a\ContentTypeContainer::TYPE, "/", $site_name ),
        $ctc_name
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
?>