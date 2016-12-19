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
    $id = "1f21f6508b7ffe834c5fe91e5e26557b"; // test-xml
    $xb  = $cascade->getAsset( a\XmlBlock::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $xb->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $xb->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo c\L::ID . $xb->getId() . BR .
                 "XML: " . $xb->getXML() . BR;

            if( $mode != 'all' )
                break;
             
        case 'set':
            // exception
            //$xml = "";
            $xml = '<report/>';
            
            $xb->setXML( $xml )->edit()->dump( true );
        
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $xb = $service->retrieve( $service->createId( 
                c\T::XMLBLOCK, $id ), c\P::XMLBLOCK );

            u\DebugUtility::dump( $xb );
        
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\XmlBlock" );
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