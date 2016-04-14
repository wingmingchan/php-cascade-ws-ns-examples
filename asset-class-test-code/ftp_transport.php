<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    $id = "4b4a41728b7f085600ae2282e04e835d"; // test-ftp
    $t  = $cascade->getAsset( a\FtpTransport::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $t->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $t->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "Host name: " . $t->getHostName() . BR .
                "Port: " . $t->getPort() . BR .
                "Directory: " . $t->getDirectory() . BR;

            if( $mode != 'all' )
                break;
             
        case 'set':
            //$t->dump( true );
            $t->setDirectory('')->
                setHostName( 'web.upstate.edu' )->
                setPort( 50 )->
                setUsername( 'Cascade' )->
                setPassword( 'Password' )->
                setDoPASV( false )->
                setDoSFTP( true )->
                edit();
            
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $t = $service->retrieve( $service->createId( 
                c\T::FTPTRANSPORT, $id ), c\P::FTPTRANSPORT );
            echo S_PRE;
            var_dump( $t );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
