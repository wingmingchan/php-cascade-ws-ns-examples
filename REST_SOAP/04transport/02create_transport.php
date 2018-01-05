<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $parent_name = "Test Transport Container";
    $parent_container = $cascade->getAsset(
        a\TransportContainer::TYPE, $parent_name, "_common" );

    $t_name = "Test FTP Transport";
    $t      = $cascade->getFtpTransport( $parent_name . "/" . $t_name, "_common" );

    if( isset( $t ) )
        $cascade->deleteAsset( $t );
        
    $t = $cascade->createFtpTransport(
        $parent_container, $t_name, "server", "22", "user", "pw" );
    
    // change from SFTP to FTP
    $t->setProtocolAuthentication(
        a\FtpTransport::PROTOCOL_TYPE_FTP,
        "",       // mode
        "1234",   // password
        false
    )->edit();
    
    $t->dump();
    
    u\DebugUtility::dumpRESTCommands( $service );
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