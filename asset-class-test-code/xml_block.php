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
    $id = "a14d54158b7f08560139425cd29a9958"; // test-xml
    $xb  = $cascade->getAsset( a\XmlBlock::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $xb->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $xb->dump( true );
            
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
            echo S_PRE;
            var_dump( $xb );
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