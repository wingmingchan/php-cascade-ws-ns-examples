<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-admin";
    $path      = "/Upstate";
    
    $service->read( 
        $service->createIdWithPathSiteNameType( 
            $path, $site_name, c\T::ASSET_FACTORY_CONTAINER ) );

    if($service->isSuccessful())
    {
        echo "Read successfully<br />";
        $container = $service->getReadAsset()->assetFactoryContainer;
        
        // edit container
        $container->applicableGroups  = "CWT-Designers;" . $site_name;
        $asset                        = new \stdClass();
        $asset->assetFactoryContainer = $container;
        
        $service->edit( $asset );

        $children   = $container->children->child;
        $child_type = c\T::ASSET_FACTORY;
        
        if( is_array( $children ) )
        {
            foreach( $children as $child )
            {
                $child_id = $child->id;
                
                $service->read( $service->createId( $child_type, $child_id ) );
                $factory = $service->getReadAsset()->assetFactory;
                
                // edit factory
                $factory->applicableGroups = "CWT-Designers;" . $site_name;
                $asset                     = new \stdClass();
                
                $asset->assetFactory = $factory;
                $service->edit( $asset );
            }
        }
        
        echo "Successfully edited asset factory container.", BR;
    }
    else
    {
        echo "Failed to read. " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>