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
    // get the image data
    $img_url     = "http://www.upstate.edu/scripts/faculty/thumbs/nadkarna.jpg";
    $img_binary  = file_get_contents( $img_url );
    
    // the folder where the file should be created
    $parent_id   = '980d653f8b7f0856015997e4bb59f630';
    $site_name   = 'cascade-admin';
    $img_name    = 'nadkarna.jpg';
    
    // create the asset
    $asset       = new \stdClass();
    $asset->file = $service->createFileWithParentIdSiteNameNameData( 
        $parent_id, $site_name, $img_name, $img_binary );
    
    $service->create( $asset );    

    if($service->isSuccessful())
        echo "Image created successfully.";
    else
        echo "Failed to create image. ", $service->getMessage();
}
catch( \Exception $e )
{
    echo $e;
}
?>