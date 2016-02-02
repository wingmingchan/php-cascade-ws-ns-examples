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
    // file to be edited
    $path = "images/nadkarna.jpg";
    
    // read the source
    $img_url     = "http://www.upstate.edu/scripts/faculty/thumbs/nadkarna.jpg";
    $img_binary  = file_get_contents( $img_url );

    
    $service->read( 
        $service->createId( a\File::TYPE, $path, "cascade-admin" ) );
        
    if($service->isSuccessful())
    {
        $file = $service->getReadFile();

        // modify the data
        $file->data = $img_binary;
    
        $asset = new \stdClass();
        $asset->file = $file;
        $service->edit( $asset );

        if ( $service->isSuccessful() )
            echo "Successfully edited the image.";
        else
            echo "Failed to edit. " . $service->getMessage();
    }
    else
    {
        echo "Error occurred: " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo $e;
}
?>