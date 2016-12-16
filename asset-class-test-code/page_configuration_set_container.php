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
    $id   = "64890d7a8b7f085600ae22821b18cabf"; // Test
    $pcsc = $cascade->getAsset( 
        a\PageConfigurationSetContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $pcsc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $pcsc->dump();
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " .            $pcsc->getId() . BR .
                 "Name: " .          $pcsc->getName() . BR .
                 "Path: " .          $pcsc->getPath() . BR .
                 "Property name: " . $pcsc->getPropertyName() . BR .
                 "Site name: " .     $pcsc->getSiteName() . BR .
                 "Type: " .          $pcsc->getType() . BR .
                 "";
                 
            $children = $pcsc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $pcsc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $pcsc_std = $service->retrieve( 
                $service->createId( 
                    c\T::PAGECONFIGURATIONSETCONTAINER, $id ), 
                    c\P::PAGECONFIGURATIONSETCONTAINER );
            
            u\DebugUtility::dump( $pcsc_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\PageConfigurationSetContainer" );
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