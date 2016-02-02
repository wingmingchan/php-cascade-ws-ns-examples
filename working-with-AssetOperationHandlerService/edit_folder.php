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
	$path = "/how-to/blocks";
	$service->read( 
        $service->createId( a\Folder::TYPE, $path, "cascade-admin" ) );
        
    if($service->isSuccessful())
    {
        echo "Read successfully<br />";
        $folder = $service->getReadAsset()->folder;
        
        $asset                          = new \stdClass();
        $asset->folder                  = $folder;
        $asset->folder->metadataSetId   = '5f4526098b7f08ee76b12c412063f8b8';
        $asset->folder->metadataSetPath = '_common_asset:Folder';

        $service->edit( $asset );
        
        if( $service->isSuccessful() )
        {
            echo "Successfully associated metadata set with folder.";
        }
        else
        {
            echo "Failed to associate metadata set with folder. " . 
                $service->getMessage();
        }
    }
    else
    {
        echo "Failed to read. " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo $e;
}
?>