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
    //$id  = "fd276cfc8b7f08560159f3f0db454558"; // root
    $id = "54b505c28b7f085600ae2282a4b7ed71"; // test
    $ctc = a\Asset::getAsset( $service, a\ContentTypeContainer::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $ctc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ctc->dump( true );
            if( $mode != 'all' )
                break;

        case 'get':
            echo c\L::ID . $ctc->getId() . BR .
                 c\L::NAME . $ctc->getName() . BR .
                 c\L::PATH . $ctc->getPath() . BR .
                 c\L::PROPERTY_NAME . $ctc->getPropertyName() . BR .
                 c\L::SITE_NAME . $ctc->getSiteName() . BR .
                 c\L::TYPE . $ctc->getType() . BR .
                 "";
                 
            $children = $ctc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            echo S_PRE;
            var_dump( $ctc->getContainerChildrenIds() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $ctc_std = $service->retrieve( 
                $service->createId( 
                    c\T::CONTENTTYPECONTAINER, $id ), 
                    c\P::CONTENTTYPECONTAINER );
            
            echo S_PRE;
            var_dump( $ctc_std );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation(
        "cascade_ws_asset\ContentTypeContainer" );
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