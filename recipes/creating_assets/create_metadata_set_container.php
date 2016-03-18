<?php 
require_once('cascade_ws_ns/auth_wing.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name         = 'web-service-tutorial';
    $ms_container_name = 'Test Metadata Set Container';
    
    if( is_null( $cascade->getMetadataSetContainer( $ms_container_name, $site_name ) ) )
    {
        $cascade->createMetadataSetContainer(
            $cascade->getAsset( a\MetadataSetContainer::TYPE, '/', $site_name ),
            $ms_container_name );
        echo "The metadata set container $ms_container_name has been created.";
    }
    else
    {
        echo "The metadata set container $ms_container_name already exists.";
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>