<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
$mode = 'display';
//$mode = 'dump';
$mode = 'get';
$mode = 'set';
//$mode = 'raw';

try
{
    $id = 'c39c35dc8b7ffe833b19adb8be309de9'; // test-cloud-transport
    $t  = $cascade->getAsset( a\CloudTransport::TYPE, $id );
    
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
                "Base path: " . u\StringUtility::getCoalescedString( $t->getBasePath() ) .
                BR, 
                "Bucket name: " . $t->getBucketName() . BR,
                "Key: " . $t->getKey() . BR,
                "Secret: " . $t->getSecret() . BR .
                "";

            if( $mode != 'all' )
                break;
             
        case 'set':
            $t->setBasePath( 'base-path' )->
                setKey( 'key' )->
                setSecret( 'secret' )->
                edit()->dump();
            
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $t = $service->retrieve( $service->createId( 
                c\T::CLOUDTRANSPORT, $id ), c\P::CLOUDTRANSPORT );
            u\DebugUtility::dump( $t );
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\CloudTransport" );
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