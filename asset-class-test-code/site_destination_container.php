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
//$mode = 'raw';

try
{
    $id  = "17b343d38b7ffe834304cee2c1ceece9"; // Test
    $sdc = $cascade->getAsset( a\SiteDestinationContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $sdc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $sdc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $sdc->getId() . BR .
                 "Name: " . $sdc->getName() . BR .
                 "Path: " . $sdc->getPath() . BR .
                 "Property name: " . $sdc->getPropertyName() . BR .
                 "Site name: " . $sdc->getSiteName() . BR .
                 "Type: " . $sdc->getType() . BR;
                 
            $children = $sdc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $sdc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $sdc_std = $service->retrieve( 
                $service->createId( 
                    c\T::SITEDESTINATIONCONTAINER, $id ), 
                    c\P::SITEDESTINATIONCONTAINER );
            
            echo S_PRE;
            var_dump( $sdc_std );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\SiteDestinationContainer" );
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