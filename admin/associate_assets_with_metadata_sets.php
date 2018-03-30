<?php
/*
This program can be used to associate assets with the corresponding metadata sets.
*/
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
    $site_name   = "formats";
    
    $admin->associateAssetsWithMetadataSets( array(
        // the type of assets to be associated with the metadata set
        a\Folder::TYPE => array(
            // the folder containing the assets
            a\Folder::TYPE      => array( "_cascade/blocks", $site_name ),
            // the metadata set
            a\MetadataSet::TYPE => $cascade->getAsset(
                a\MetadataSet::TYPE, "6188622e8b7ffe8377b637e84e639b54" )
        ),
        a\XmlBlock::TYPE => array(
            a\Folder::TYPE      => "48a581eb8b7ffe834bd90c8f2ef6b1bb",
            a\MetadataSet::TYPE => "618861da8b7ffe8377b637e8ad3dd499"
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