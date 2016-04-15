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
    $id  = "980a86318b7f0856015997e49219bef0";
    $psc = $cascade->getAsset( a\PublishSetContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $psc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $psc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " .            $psc->getId() . BR .
                 "Name: " .          $psc->getName() . BR .
                 "Path: " .          $psc->getPath() . BR .
                 "Property name: " . $psc->getPropertyName() . BR .
                 "Site name: " .     $psc->getSiteName() . BR .
                 "Type: " .          $psc->getType() . BR .
                 "";
                 
            $children = $psc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $psc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $psc_std = $service->retrieve( 
                $service->createId( 
                    c\T::PUBLISHSETCONTAINER, $id ), 
                    c\P::PUBLISHSETCONTAINER );
            
            echo S_PRE;
            var_dump( $psc_std );
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
