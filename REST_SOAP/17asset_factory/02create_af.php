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
    $afc_name  = "Test AF Container";
    $af_name   = "Page";
    
    $af = $cascade->getAssetFactory( "$afc_name/$af_name", $site_name );
    
    if( isset( $af ) )
    {
        $cascade->deleteAsset( $af );
    }
    
    $page_name = "base_page";
    $page_path = "_cascade/$page_name";
    $page      = $cascade->getPage( $page_path, $site_name );
    
    if( !isset( $page ) )
    {
        $page = $cascade->createPage(
            $cascade->getAsset( a\Folder::TYPE, "_cascade", $site_name ),
            $page_name,
            $cascade->getAsset(
                a\ContentType::TYPE, "Test CT Container/Page", $site_name )
        );
    }
  
    $af = $cascade->createAssetFactory(
        $cascade->getAsset( a\AssetFactoryContainer::TYPE, $afc_name, $site_name ),
        $af_name,
        a\Page::TYPE
    );
    
    $af->setBaseAsset( $page )->
        setDescription( "Create a new page" )->
        setOverwrite( true )->
        addGroupName( "test-ws-group" )->edit();
  
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