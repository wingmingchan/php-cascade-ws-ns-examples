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
    $ct_name   = "Page";
    
    $ct = $cascade->getContentType( "$ctc_name/$ct_name", $site_name );
    
    if( isset( $ct ) )
    {
        $cascade->deleteAsset( $ct );
    }
    
    $ct = $cascade->createContentType(
        $cascade->getAsset(
            a\ContentTypeContainer::TYPE, $ctc_name, $site_name ),
        $ct_name,
        $cascade->getAsset(
            a\PageConfigurationSet::TYPE, "Test CS Container/Page", $site_name ),
        $cascade->getAsset(
            a\MetadataSet::TYPE, "Test MS Container/Page", $site_name ),
        $cascade->getAsset(
            a\DataDefinition::TYPE, "Test DD Container/Page", $site_name )
    );
    
    
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