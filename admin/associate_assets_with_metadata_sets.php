<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name = "formats";

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();

    $folder_id   = "4d2ef6228b7ffe834bd90c8f61354784";
    $folder_path = "_cascade/formats/page-elements";
    $f_ms_id     = "4cb790e88b7ffe834bd90c8f6f190bf4";
    $f_ms_path   = "Folder";
    $site_name   = "formats";

    $folder      = $cascade->getAsset( a\Folder::TYPE, $folder_id );
    $ms          = $cascade->getAsset( a\MetadataSet::TYPE, $f_ms_id );
    
    $admin->associateAssetsWithMetadataSets( array(
        // the type of assets to be associated with the metadata set
        a\Folder::TYPE => array(
            // the folder containing the assets
            a\Folder::TYPE      => array( $folder_path, $site_name ),
            // the metadata set
            a\MetadataSet::TYPE => array( $f_ms_path, $site_name )
        )
    ) );
    
    u\DebugUtility::outputDuration( $start_time );
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