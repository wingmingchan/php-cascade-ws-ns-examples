<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    $id = '042cdef08b7ffe8339ce5d137abd4718'; // test-db
    $t  = $cascade->getAsset( a\DatabaseTransport::TYPE, $id );
    
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
            echo 
                "Database name: " . $t->getDatabaseName() . BR .
                "Username: " . $t->getUsername() . BR;

            if( $mode != 'all' )
                break;
             
        case 'set':
            //$t->dump( true );
            $t->
                setTransportSiteId( 1 )->
                setServerName( 'db' )->
                setServerPort( 80 )->
                setUsername( 'user' )->
                setDatabaseName( 'db' )->
                setPassword( '' )->
                edit();
            
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $t = $service->retrieve( $service->createId( 
                c\T::DATABASETRANSPORT, $id ), c\P::DATABASETRANSPORT );
            echo S_PRE;
            var_dump( $t );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\DatabaseTransport" );
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