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
$mode = 'set';

try
{
    $id = 'ebe262c38b7f085601e990b4821e309d'; // page reference
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
                $cascade->getAsset( a\Page::TYPE, '96f6e5138b7f0856002a5e11fa547b61' )
            );
            $r->getReferencedAsset()->publish();
            
            if( $mode != 'all' )
                break;

        case 'raw':
            $r = $service->retrieve( 
                $service->createId( c\T::REFERENCE, $id), c\P::REFERENCE );

            echo S_PRE;
            var_dump( $r );
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