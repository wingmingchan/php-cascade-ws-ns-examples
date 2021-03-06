<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name        = 'web-service-test';
    
    // create transport container
    $transport_parent = $cascade->createTransportContainer(
        $cascade->getAsset( a\TransportContainer::TYPE, '/', $site_name ),
        'Test Transport Container'
    );
    
    // create ftp transport
    $ftp_transport = $cascade->createFtpTransport(
        $transport_parent, // parent container
        'webapp-ftp',      // name
        'cascade',         // host
        '123',             // port
        'test',            // username
        'test'             // password
    )->setDoPASV( true )->edit();
    
    // create destination container
    $destination_parent = $cascade->createSiteDestinationContainer(
        $cascade->getAsset( a\SiteDestinationContainer::TYPE, '/', $site_name ),
        'Test Destination Container'
    );
    
    // create destination
    $destination = $cascade->createDestination(
        $destination_parent,
        'Web-Service-Test-Web',
        $ftp_transport
    )->
    enable()->
    addGroup( $cascade->getAsset( a\Group::TYPE, 'web-service-test-group' ) )->
    edit();
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