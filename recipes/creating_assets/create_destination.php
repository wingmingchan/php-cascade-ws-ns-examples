<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name         = 'web-service-tutorial';
    $group_name        = 'web-service-tutorial-group';
    $destination_container_name = 'Test Destination Container';
    $destination_container      = $cascade->getSiteDestinationContainer( $destination_container_name, $site_name );
    
    if( is_null( $destination_container ) )
    {
        // create destination container
        $destination_container = $cascade->createSiteDestinationContainer(
            $cascade->getAsset( 
                a\SiteDestinationContainer::TYPE, '/', $site_name ),
            $destination_container_name
        );
    }
    
    $ftp_transport    = $cascade->getAsset( a\FtpTransport::TYPE, 'Test Transport Container/webapp-ftp', $site_name );
    $destination_name = 'Web-Service-tutorial-Web';
    $destination      = $cascade->getSiteDestinationContainer( $destination_container_name . '/' . $destination_name, $site_name );

    if( is_null( $destination ) )
    {
        // create destination
        $destination = $cascade->createDestination(
            $destination_container,
            $destination_name,
            $ftp_transport
        )->
        enable()->
        addGroup( $cascade->getAsset( a\Group::TYPE, $group_name ) )->
        edit();
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>