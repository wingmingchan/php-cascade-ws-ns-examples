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
    $id  = "fd276e5a8b7f08560159f3f0e8f79c2f";
    $psc = $cascade->getAsset( a\PublishSetContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $psc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $psc->dump();
            
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
            
            u\DebugUtility::dump( $psc->getContainerChildrenIds() );
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $psc_std = $service->retrieve( 
                $service->createId( 
                    c\T::PUBLISHSETCONTAINER, $id ), 
                    c\P::PUBLISHSETCONTAINER );
            
            u\DebugUtility::dump( $psc_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\PublishSetContainer" );
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