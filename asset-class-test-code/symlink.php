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
//$mode = 'set';
//$mode = 'metadata';
//$mode = 'raw';

try
{
    $id = 'df9c18a08b7f085600adcd817d0f5060';
    $s  = $cascade->getAsset( a\Symlink::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $s->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $s->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo
                "Name: " . $s->getName() . BR .

                "ID: " . $s->getId() . BR .
                "Path: " . $s->getPath() . BR .
                "Site ID: " . $s->getSiteId() . BR .
                "Site name: " . $s->getSiteName() . BR .
                "Property name: " . $s->getPropertyName() . BR .
                "Type: " . $s->getType() . BR .
                "Created date: " . $s->getCreatedDate() . BR .
                "Created by: " . $s->getCreatedBy() . BR .
                "Last modified date: " . $s->getLastModifiedDate() . BR .
                "Last modified by: " . $s->getLastModifiedBy() . BR .
                "Parent folder ID: " . $s->getParentContainerId() . BR .
                "Parent folder path: " . $s->getParentContainerPath() . BR .
                "Metadata set ID: " . $s->getMetadataSetId() . BR .
                "Metadata set path: " . $s->getMetadataSetPath() . BR .
                "Expiration folder ID: " . ( 
                    $s->getExpirationFolderId() == NULL ? 
                    'NULL' : $s->getExpirationFolderId() ). BR .
                "Expiration folder path: " . 
                    $s->getExpirationFolderPath() . BR .
                "Expiration folder recycled: " . 
                    $s->getExpirationFolderRecycled() . BR .
                "Link URL: " . $s->getLinkURL() . BR; 
        
            if( $mode != 'all' )
                break;

        case 'set':
            $s->setLinkURL( "http://web.upstate.edu/cascade-training/" )->
                edit()->dump( true );
        
            if( $mode != 'all' )
                break;
            
        case 'metadata':
            $m          = $s->getMetadata();
            $field_name = 'exclude-from-menu-bar';
            
            if( $m->hasDynamicField( $field_name ) )
            {
                var_dump( $m->getMetadataSet()->
                    getDynamicMetadataFieldPossibleValueStrings( 
                        $field_name ) );
                $m->setDynamicField( $field_name , 'Yes' );
            }
            
            $field_name = 'displayed-as-submenu';
            
            if( $m->hasDynamicField( $field_name ) )
            {
                var_dump( $m->getMetadataSet()->
                    getDynamicMetadataFieldPossibleValueStrings( 
                        $field_name ) );
                $m->setDynamicField( $field_name , 'Yes' );
            }
            
            $s->edit();
            
            if( $mode != 'all' )
                break;
            
        case 'raw':
            $s_std = $service->retrieve( 
                $service->createId( c\T::SYMLINK, $id), c\P::SYMLINK );

            echo S_PRE;
            var_dump( $s_std );
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