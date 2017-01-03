<?php 
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site = $cascade->getSite( "cascade-admin" );
    
    $base_folder_asset_tree   = $site->getBaseFolderAssetTree();
    $asset_factory_asset_tree = $site->getRootAssetFactoryContainerAssetTree();
    $metadata_set_asset_tree  = $site->getRootMetadataSetContainerAssetTree();
    $content_type_asset_tree  = $site->getRootContentTypeContainerAssetTree();
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