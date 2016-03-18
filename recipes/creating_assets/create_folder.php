<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name               = 'web-service-tutorial';
    $base_assets_folder_name = "base-assets";
    $base_folder             = $cascade->getAsset( a\Folder::TYPE, "/", $site_name );
    $base_assets_folder      = $cascade->getFolder( $base_assets_folder_name, $site_name );
    
    if( is_null( $base_assets_folder ) )
    {
        $base_assets_folder = 
            $cascade->
                createFolder(
                    $base_folder,
                    $base_assets_folder_name );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>