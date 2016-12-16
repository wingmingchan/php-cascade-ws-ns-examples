<?php
require_once('auth_chanw.php');

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
//$mode = 'set';

try
{
    $id = '09632b148b7f08ee689d91ad208ed081'; // page reference
    $r  = $cascade->getAsset( a\Reference::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $r->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $r->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo
                c\L::NAME . $r->getName() . BR .
                c\L::ID . $r->getId() . BR .
                c\L::PATH . $r->getPath() . BR .
                c\L::SITE_ID . $r->getSiteId() . BR .
                c\L::SITE_NAME . $r->getSiteName() . BR .
                c\L::PROPERTY_NAME . $r->getPropertyName() . BR .
                c\L::TYPE . $r->getType() . BR .
                c\L::CREATED_DATE . $r->getCreatedDate() . BR .
                c\L::CREATED_BY . $r->getCreatedBy() . BR .
                c\L::LAST_MODIFIED_DATE . $r->getLastModifiedDate() . BR .
                c\L::LAST_MODIFIED_BY . $r->getLastModifiedBy() . BR .
                c\L::PARENT_FOLDER_ID . $r->getParentContainerId() . BR .
                c\L::PARENT_FOLDER_PATH . $r->getParentContainerPath() . BR;
                
            $asset = $r->getReferencedAsset();
            
            if( $asset->getType() == c\T::PAGE )
            {
                $asset->getDataDefinition()->dump( true );
            }
        
            if( $mode != 'all' )
                break;
            
        case 'set':
            $r->setAsset( 
                $cascade->getAsset( a\Page::TYPE, 'aefe9f168b7f08ee02067bea0e5de36b' )
            );
            //$r->getReferencedAsset()->publish();
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $r = $service->retrieve( 
                $service->createId( c\T::REFERENCE, $id), c\P::REFERENCE );

            u\DebugUtility::dump( $r );
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Reference" );
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