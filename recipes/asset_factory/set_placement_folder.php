<?php
/* This program is used to set the placement folder
for an asset factory for uploading files.
*/
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $sites = $cascade->getSites();
    
    foreach( $sites as $site )
    {
        try
        {
            $af = $cascade->getAsset( 
                a\AssetFactory::TYPE, 
                "Upstate/Upload 520X270 Image", // factory name
                $site->getPathPath()            // site name
            );
            
            $af->setPlacementFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'images', $site->getPathPath() ) 
                    )->
                setAllowSubfolderPlacement( true )->
                setOverwrite( true )->
                setFolderPlacementPosition( 0 )->
                edit();
        }
        catch( \Exception $e ) // if the factory does not exist in a site, skip it
        {
            echo $site->getPathPath() . 
                " failed to modify Upload 520X270 Image" . BR;
            echo S_PRE . $e . E_PRE;
            continue;
        }
    }
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