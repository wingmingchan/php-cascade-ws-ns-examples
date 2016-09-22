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
//$mode = 'set';
//$mode = 'raw';

try
{
    $id = "d051de5f8b7f085601675d706ac3325c"; // test-xml
    $fb  = $cascade->getAsset( a\FeedBlock::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $fb->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $fb->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo c\L::ID . $fb->getId() . BR .
                 c\L::NAME . $fb->getName() . BR .
                 c\L::CREATED_BY . $fb->getCreatedBy() . BR .
                 c\L::CREATED_DATE . $fb->getCreatedDate() . BR .
                 c\L::EXPIRATION_FOLDER_ID . $fb->getExpirationFolderId() . BR .
                 c\L::EXPIRATION_FOLDER_PATH . $fb->getExpirationFolderPath() . BR .
                 c\L::LAST_MODIFIED_BY . $fb->getLastModifiedBy() . BR .
                 c\L::LAST_MODIFIED_DATE . $fb->getLastModifiedDate() . BR .
                 c\L::METADATA_SET_ID . $fb->getMetadataSetId() . BR .
                 c\L::METADATA_SET_PATH . $fb->getMetadataSetPath() . BR .
                 c\L::PARENT_FOLDER_ID . $fb->getParentContainerId() . BR .
                 c\L::PARENT_FOLDER_PATH . $fb->getParentContainerPath() . BR .
                 c\L::PATH . $fb->getPath() . BR .
                 c\L::PROPERTY_NAME . $fb->getPropertyName() . BR .
                 c\L::SITE_ID . $fb->getSiteId() . BR .
                 c\L::SITE_NAME . $fb->getSiteName() . BR .
                 c\L::TYPE . $fb->getType() . BR .
                "Feed URL: " . $fb->getFeedURL() . BR .
                 "";

            if( $mode != 'all' )
                break;
             
        case 'set':
            $url = "http://www.upstate.edu/scripts/cascade/" . 
            "process_item.php?cat=bluepages&id=bp1077";
            
            $fb->setFeedURL( $url )->edit()->dump();
        
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $fb = $service->retrieve( $service->createId( 
                c\T::FEEDBLOCK, $id ), c\P::FEEDBLOCK );
            echo S_PRE;
            var_dump( $fb );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }
    
    u\ReflectionUtility::showMethodSignatures( "cascade_ws_asset\FeedBlock" );
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