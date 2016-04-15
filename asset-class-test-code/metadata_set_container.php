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
    $id = "647db3ab8b7f085600ae2282d55a5b6d"; // Test
    $msc = $cascade->getAsset( a\MetadataSetContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $msc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $msc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " .            $msc->getId() . BR .
                 "Name: " .          $msc->getName() . BR .
                 "Path: " .          $msc->getPath() . BR .
                 "Property name: " . $msc->getPropertyName() . BR .
                 "Site name: " .     $msc->getSiteName() . BR .
                 "Type: " .          $msc->getType() . BR .
                 "";
                 
            $children = $msc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $msc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $msc_std = $service->retrieve( 
                $service->createId( 
                    c\T::METADATASETCONTAINER, $id ), 
                    c\P::METADATASETCONTAINER );
            
            echo S_PRE;
            var_dump( $msc_std );
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
