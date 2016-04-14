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
//$mode = 'copy';
//$mode = 'delete';
//$mode = 'metadata-set';
//$mode = 'raw';

try
{
    // base folder
    //$id = '980a854e8b7f0856015997e463c84a37';
    // test-child-folder
    //$id = '211c50a78b7f08560139425cdddf003a';
    // reports
    //$id = '5b9f96508b7f0856002a5e1165b08427';
    // test-Folder
    $id = 'b8bf838f8b7f0856002a5e11586fba90';
    
    $f = $cascade->getAsset( a\Folder::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $f->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $f->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            /* === methods from Asset == */
            echo c\L::ID .            $f->getId() .           BR .
                 c\L::NAME .          $f->getName() .         BR .
                 c\L::PATH .          $f->getPath() .         BR .
                 c\L::SITE_ID .       $f->getSiteId() .       BR .
                 c\L::SITE_NAME .     $f->getSiteName() .     BR .
                 c\L::TYPE .          $f->getType() .         BR .
                 c\L::PROPERTY_NAME . $f->getPropertyName() . HR;
                 
            echo "Dumping identifier " . S_PRE;     
            var_dump( $f->getIdentifier() );
            echo E_PRE . HR;
            
            echo "Dumping property " . S_PRE;     
            //var_dump( $f->getProperty() );
            echo E_PRE . HR;
            
            /* === methods from Container == */
            $children = $f->getChildren();
            
            foreach( $children as $child )
            {
                echo S_PRE;
                //var_dump( $child->toStdClass() );
                echo E_PRE;
            }
            
            $folder_children_ids = $f->getFolderChildrenIds();
            echo "Number of folder children: " . 
                count( $folder_children_ids ) . BR;
            
            foreach( $folder_children_ids as $folder_id )
            {
                var_dump( $folder_id );
                echo BR;
            }
            
            echo c\L::PARENT_CONTAINER_ID . $f->getParentFolderId() . BR .
                 c\L::PARENT_CONTAINER_PATH . $f->getParentFolderPath() . BR;
            
            echo HR;
        
            /* === methods from Folder == */
            echo c\L::CREATED_BY .   $f->getCreatedBy() .   BR .
                 c\L::CREATED_DATE . $f->getCreatedDate() . BR .
                 c\L::EXPIRATION_FOLDER_ID .   $f->getExpirationFolderId() .   BR .
                 c\L::EXPIRATION_FOLDER_PATH . $f->getExpirationFolderPath() . BR .
                 c\L::LAST_MODIFIED_BY .   $f->getLastModifiedBy() .   BR .
                 c\L::LAST_MODIFIED_DATE . $f->getLastModifiedDate() . BR .
                 c\L::LAST_PUBLISHED_BY .   $f->getLastPublishedBy() .   BR .
                 c\L::LAST_PUBLISHED_DATE . $f->getLastPublishedDate() . BR .
                 c\L::METADATA_SET_ID .   $f->getMetadataSetId() .   BR .
                 c\L::METADATA_SET_PATH . $f->getMetadataSetPath() . BR .
                 c\L::SHOULD_BE_INDEXED .   ( $f->getShouldBeIndexed() ?
                     'true' : 'false' ) . BR .
                 c\L::SHOULD_BE_PUBLISHED . ( $f->getShouldBePublished() ?
                     'true' : 'false' ) . BR .
                 HR;
                
            $field_name = 'exclude-from-left';
            echo "Dumping dynamic field $field_name" . S_PRE;
            
            if( $f->hasDynamicField( $field_name ) )
                var_dump( $f->getDynamicField( $field_name ) );
            echo E_PRE . HR;
            
            echo "Dumping dynamic fields" . S_PRE;
            //var_dump( $f->getDynamicFields() );
            echo E_PRE . HR;
            
            echo "Dumping workflow settings";

            $wfs = $f->getWorkflowSettings();
            echo S_PRE;
            var_dump( $wfs->toStdClass() );
            echo E_PRE;
            
            
            //$wfs->unsetInheritWorkflows()->setRequireWorkflow( true );
            //$f->editWorkflowSettings( true, true );

            //$wf = a\Asset::getAsset( 
                //$service, c\T::WORKFLOWDEFINITION, 
                //'65221ba58b7f085600ae22825f36b20e' );
            //$f->addWorkflow( $wf )->editWorkflowSettings( true, true );
            
            echo S_PRE;
            //var_dump( $wfs->toStdClass() );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;

        case 'set':
            //$f->setShouldBeIndexed( true )->setShouldBePublished( true )->
                //edit()->dump( true );
        
            if( $mode != 'all' )
                break;
            
        case 'copy':
            $parent     = $cascade->getAsset( 
                c\T::FOLDER, $f->getParentFolderId() );
            $new_folder = $f->copy( $parent, 'test-folder2' );
            $new_folder->display();
        
            if( $mode != 'all' )
                break;
            
        case 'delete':
        /*
            $temp_folder = a\Folder::getAsset( 
                $service, c\T::FOLDER, 'bbfb7df38b7f085601ecbac86deba515' );
            $temp_folder->deleteAllChildren();
        */
            if( $mode != 'all' )
                break;
            
        case 'metadata-set':
            // set it to _common:Directory Info
            $f->setMetadataSet( $cascade->getAsset( 
                    a\MetadataSet::TYPE, 
                    '090c64688b7f0856015997e4a6d0d963' ) )->
                    dump( true );
        
            if( $mode != 'all' )
                break;
            
        case 'raw':
            $folder = $service->retrieve( 
                $service->createId( c\T::FOLDER, $id), c\P::FOLDER );

            echo S_PRE;
            var_dump( $folder );
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