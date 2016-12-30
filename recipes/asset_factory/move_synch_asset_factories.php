<?php 
require_once( 'cascade_ws_ns/auth_chanw.php' );
require_once( '/webfs/www/nosync/cascade/admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_names = array(
        "database-test",
    );
    
    foreach( $site_names as $site_name )
    {
        $root_af_container = $cascade->getSite(
            $site_name )->getRootAssetFactoryContainer();
        $create_container  = $cascade->getAssetFactoryContainer( "Create", $site_name );
        $upload_container  = $cascade->getAssetFactoryContainer( "Upload", $site_name );
        
        if( !isset( $create_container ) )
        {
            // create asset factory container
            $create_container = $cascade->createAssetFactoryContainer(
                $root_af_container,
                "Create"
            );
        }
        
        if( !isset( $upload_container ) )
        {
            // create asset factory container
            $create_container = $cascade->createAssetFactoryContainer(
                $root_af_container,
                "Upload"
            );
        }
        
        
        
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>