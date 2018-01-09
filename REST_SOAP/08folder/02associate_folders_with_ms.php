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
    $site      = $cascade->getSite( $site_name );
    $msc_name  = "Test MS Container";
    $folder_ms_name = "Folder";
    $folder_ms = $cascade->getMetadataSet( "$msc_name/$folder_ms_name", $site_name );
    
    if( !isset( $folder_ms ) )
        $folder_ms = $cascade->createMetadataSet(
            $cascade->getAsset( a\MetadataSetContainer::TYPE, $msc_name, $site_name ),
            $folder_ms_name
        );

    $params = array( a\Folder::TYPE => array( a\MetadataSet::TYPE => $folder_ms ) );

    $site->getRootFolderAssetTree()->traverse(
        array( a\Folder::TYPE => array( "assetTreeAssociateWithMetadataSet" ) ),
        $params
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