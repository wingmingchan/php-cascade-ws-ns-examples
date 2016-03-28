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
//$mode = 'raw';

try
{
    $id  = "5501cc048b7f085600ae2282a4d548b7"; // test
    $ddc = $cascade->getAsset( a\DataDefinitionContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $ddc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ddc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $ddc->getId() . BR .
                 "Name: " . $ddc->getName() . BR .
                 "Path: " . $ddc->getPath() . BR .
                 "Property name: " . $ddc->getPropertyName() . BR .
                 "Site name: " . $ddc->getSiteName() . BR .
                 "Type: " . $ddc->getType() . BR .
                 "";
                 
            $children = $ddc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $ddc_std = $service->retrieve( 
                $service->createId( 
                    c\T::DATADEFINITIONCONTAINER, $id ), 
                    c\P::DATADEFINITIONCONTAINER );
            
            echo S_PRE;
            var_dump( $ddc_std );
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
