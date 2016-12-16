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
    $id = '08378e518b7ffe8339ce5d1372331a0f'; // test-fs
    $t  = $cascade->getAsset( a\FileSystemTransport::TYPE, $id );
    
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
                "Directory: " . $t->getDirectory() . BR .
                "";

            if( $mode != 'all' )
                break;
             
        case 'set':
            //$t->dump( true );
            $t->// exception: empty string
                //setDirectory( '' )->
                setDirectory( 'about' )->
                edit();
            
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $t = $service->retrieve( $service->createId( 
                c\T::FSTRANSPORT, $id ), c\P::FILESYSTEMTRANSPORT );
            u\DebugUtility::dump( $t );
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\FileSystemTransport" );
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