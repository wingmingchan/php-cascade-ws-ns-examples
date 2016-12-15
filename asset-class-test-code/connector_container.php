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
$mode = 'get';
//$mode = 'raw';

try
{
    $id = "03dbe3628b7ffe8339ce5d132b740004"; // Connectors
    $cc = a\Asset::getAsset( $service, a\ConnectorContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $cc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $cc->dump();
            if( $mode != 'all' )
                break;

        case 'get':
            echo c\L::ID . $cc->getId() . BR .
                 c\L::NAME . $cc->getName() . BR .
                 c\L::PATH . $cc->getPath() . BR .
                 c\L::PROPERTY_NAME . $cc->getPropertyName() . BR .
                 c\L::SITE_NAME . $cc->getSiteName() . BR .
                 c\L::TYPE . $cc->getType() . BR .
                 "";
                 
            $children = $cc->getChildren();
            
            if( count( $children ) > 0 )
            {
                foreach( $children as $child )
                {
                    echo $child->getPathPath() . BR;
                }
            }
            
            u\DebugUtility::dump( $cc->getContainerChildrenIds() );
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $cc_std = $service->retrieve( 
                $service->createId( 
                    c\T::CONNECTORCONTAINER, $id ), 
                    c\P::CONNECTORCONTAINER );
            
            u\DebugUtility::dump( $cc_std );
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\ConnectorContainer" );
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
