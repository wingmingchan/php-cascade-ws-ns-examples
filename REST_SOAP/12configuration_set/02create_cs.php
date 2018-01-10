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
    $csc_name  = "Test CS Container";
    $cs_name   = "Page";
    
    $cs = $cascade->getPageConfigurationSet( "$csc_name/$cs_name", $site_name );
    
    if( isset( $cs ) )
    {
        $cascade->deleteAsset( $cs );
    }
    
    $cs = $cascade->createPageConfigurationSet(
        $cascade->getAsset(
            a\PageConfigurationSetContainer::TYPE, $csc_name, $site_name ),
        $cs_name,
        "Page",
        $cascade->getAsset( a\Template::TYPE, "_cascade/template/xml", $site_name ),
        '.php',
        c\T::HTML
    );
    
    $cs->
        setFormat(
            "Page",
            $cascade->getAsset( 
                a\XsltFormat::TYPE, 
                '_cascade/formats/page_template', $site_name ) )->
        setConfigurationPageRegionBlock( 
            "Page",
            "DEFAULT",
            $cascade->getAsset( 
                a\IndexBlock::TYPE, "_cascade/blocks/index/calling-page", $site_name ) )->
        setConfigurationPageRegionFormat(
            "Page",
            "DEFAULT",
            $cascade->getAsset( 
                a\ScriptFormat::TYPE, "_cascade/formats/default", $site_name ) )->
        setPublishable( "Page", true )->
        edit();
    
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