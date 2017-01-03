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
    $site_name         = 'web-service-tutorial';
    $transport_container_name = 'Test Transport Container';
    $transport_container      = $cascade->getTransportContainer( $transport_container_name, $site_name );

    if( is_null( $transport_container ) )
    {
        // create transport container
        $transport_container = $cascade->createTransportContainer(
            $cascade->getAsset( a\TransportContainer::TYPE, '/', $site_name ),
                $transport_container_name
        );
    }

    $transport_name = 'webapp-ftp';
    $transport      = $cascade->getFtpTransport( $transport_container_name . '/' . $transport_name, $site_name );
    
    if( is_null( $transport ) )
    {
        // create ftp transport
        $ftp_transport = $cascade->createFtpTransport(
            $transport_container, // parent container
            $transport_name,
            'cascade',            // host
            '123',                // port
            'test',               // username
            'test'                // password
        )->setDoPASV( true )->edit();
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