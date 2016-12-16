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
//$mode = 'copy';
//$mode = 'set';
//$mode = 'metadata-set';
//$mode = 'raw';

/* Note that the metadata set is reset in 
$mode = 'metadata-set';
this has to be changed to re-run the test!
*/

try
{
    $id = "081d805b8b7ffe8339ce5d1303b53a50"; // test.css
    $f  = $cascade->getAsset( a\File::TYPE, $id );
    
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
            echo c\L::ID . $f->getId() . BR .
                 c\L::CREATED_BY . $f->getCreatedBy() . BR .
                 c\L::CREATED_DATE . $f->getCreatedDate() . BR .
                 c\L::DATA . $f->getData() . BR .
                 c\L::EXPIRATION_FOLDER_ID . $f->getExpirationFolderId() . BR .
                 c\L::EXPIRATION_FOLDER_PATH . $f->getExpirationFolderPath() . BR .
                 c\L::LAST_MODIFIED_BY . $f->getLastModifiedBy() . BR .
                 c\L::LAST_MODIFIED_DATE . $f->getLastModifiedDate() . BR .
                 c\L::LAST_PUBLISHED_BY . $f->getLastPublishedBy() . BR .
                 c\L::LAST_PUBLISHED_DATE . $f->getLastPublishedDate() . BR .
                 c\L::MAINTAIN_ABSOLUTE_LINKS . 
                    ( $f->getMaintainAbsoluteLinks() ? 'true' : 'false' ) . BR .
                 c\L::METADATA_SET_ID . $f->getMetadataSetId() . BR .
                 c\L::METADATA_SET_PATH . $f->getMetadataSetPath() . BR .
                 c\L::PARENT_FOLDER_ID . $f->getParentContainerId() . BR .
                 c\L::PARENT_FOLDER_PATH . $f->getParentContainerPath() . BR .
                 c\L::REWRITE_LINKS . 
                     ( $f->getRewriteLinks() ? 'true' : 'false' ) . BR .
                 c\L::SHOULD_BE_INDEXED . 
                     ( $f->getShouldBeIndexed() ? 'true' : 'false' ) . BR .
                 c\L::SHOULD_BE_PUBLISHED . 
                     ( $f->getShouldBePublished() ? 'true' : 'false' ) . BR .
                 c\L::TEXT . $f->getText() . BR;
            
            $df_name = "multiselect";
            
            if( $f->hasDynamicField( $df_name ) )
            {
                echo S_PRE;
                var_dump( $f->getDynamicField( $df_name )->toStdClass() );
                echo E_PRE;
            }
            else
            {
                echo "The field $df_name does not exist" . BR;
            }
            
            echo S_PRE;
            var_dump( $f->getDynamicFields() );
            echo E_PRE;

            if( $mode != 'all' )
                break;
                
        case 'set':
            $text = $f->getText();
            $text .= "body{background:#fff;}";
            $f->setText( $text )->
                setShouldBeIndexed( false )->
                setShouldBePublished( false )->
                   setMaintainAbsoluteLinks( false )->
                setRewriteLinks( false )->
                edit()->dump( true );
        
            if( $mode != 'all' )
                break;

        case 'copy':
            $parent   = $cascade->getAsset( 
                c\T::FOLDER, $f->getParentContainerId() );
            $new_file = $f->copy( $parent, 'test2.css' );
            $new_file->display();
      
            if( $mode != 'all' )
                break;
        
        case 'metadata-set':
            $f->setMetadataSet( $cascade->getAsset( 
                    a\MetadataSet::TYPE, 
                    '4dddf3e58b7f085600a0fcdc06afa7df' ) )->
                dump( true );
      
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $f = $service->retrieve( $service->createId( 
                c\T::FILE, $id ), c\P::FILE );
            echo S_PRE;
            var_dump( $f );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\File" );
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